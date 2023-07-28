<?php

namespace App\Controller;

use App\Entity\RepairType;
use App\Entity\ServiceInfo;
use App\Entity\VehicleModel;
use App\Form\ServiceInfoType;
use App\Service\ServiceInfoManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/index', name: 'app_home', methods: ['get','post'])]
    public function index(Request $request, EntityManagerInterface $entityManager, ServiceInfoManager $serviceInfoManager): Response
    {
        $form = $this->createForm(ServiceInfoType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            
            $data = $form->getData();
            $foundCustomer = $this->_checkCustomerIfExist($data, $entityManager);

            if ($foundCustomer) {
                return $this->json([
                    'alert' => 'warning',
                    'message' => 'Bu müşteri kaydı zaten var.'
                ]);
            }

            $foundData = $this->_checkRepairPlaceIfFull($data, $entityManager, $request);

            if ($foundData) {
                return $this->json([
                    'alert' => 'warning',
                    'message' => 'Seçtiğiniz tamir tarihinde tamir yeri doludur.'
                ]);
            }
            
            // kayıt işlemi için servisi çağırıyoruz
            $serviceInfoManager->create($data, $request, $entityManager);

            return $this->json([
                'alert' => 'success',
                'message' => 'Form başarıyla kaydedildi.'
            ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** getvehiclemodels
    *   Araç markası seçildiğinde
    *   araç modelini db'den alan method
    */
    #[Route('/getModel', name: 'get_model', methods: 'post')]
    public function getVehicleModel(Request $request, EntityManagerInterface $entityManager): Response
    {
        // ajaxtan gelen brand idsini alıyoruz.
        $id = $request->request->get('id');

        $vehicleModels = $entityManager->getRepository(VehicleModel::class)->findBy(['brand' => $id]);

        $models = [];
        foreach ($vehicleModels as $vehicleModel) {
            $models[$vehicleModel->getId()] = $vehicleModel->getName();
        }

        return $this->json([
            'message' => 'model seçebilirsiniz',
            'vehicle_models' => $models,
        ]);
    }

    /** 
    *   tamir türü seçildiğinde
    *   tamir yerini db'den alan method
    */
    #[Route('/getRepairPlace', name: 'get_repair_place', methods: 'post')]
    public function getRepairPlace(Request $request, EntityManagerInterface $entityManager): Response
    {
        // ajaxtan gelen repairType idsini alıyoruz.
        $id = $request->request->get('id');

        $repairPlaces = $entityManager->getRepository(RepairType::class)->find($id)->getRepairPlaces();

        $models = [];
        foreach ($repairPlaces as $repairPlace) {
            $models[$repairPlace->getId()] = $repairPlace->getName();
        }

        return $this->json([
            'message' => 'type seçebilirsiniz',
            'repair_places' => $models,
        ]);
    }

    // 
    public function _checkCustomerIfExist($data, $entityManager)
    {
        $name = $this->_normalizeString($data->getCustomer()->getName());
        $surname = $this->_normalizeString($data->getCustomer()->getSurname());

        $queryBuilder = $entityManager->createQueryBuilder();
        /**
         * customer tablosunda bu isimde kayıt var mı ona bakıyoruz
         * büyük/küçük harf ve türkçe karakterlere duyarsız bir şekilde.
         */
        $foundCustomer = $queryBuilder
            ->select('c')
            ->from('App\Entity\Customer', 'c')
            // ->where('c.name LIKE :name')
            // ->andWhere('c.surname LIKE :surname')
            // ->setParameter('name', $name)
            // ->setParameter('surname', $surname)
            ->where($queryBuilder->expr()->like('c.name', $queryBuilder->expr()->literal('%' . $name . '%')))
            ->where($queryBuilder->expr()->like('c.name', $queryBuilder->expr()->literal('%' . $surname . '%')))
            ->getQuery()
            ->getResult();

        if ($foundCustomer) {
            return true;
        }
        return false;
    }

    public function _normalizeString($name) {
        // Türkçe karakterleri düzleştir ve küçük harfe çevir
        $str = mb_strtolower($name, 'UTF-8');
        
        // Türkçe karakterleri normal harflere çevir
        $turkishChars = array('ç', 'ğ', 'ı', 'i', 'ö', 'ş', 'ü');
        $normalChars = array('c', 'g', 'i', 'i', 'o', 's', 'u');
        $str = str_replace($turkishChars, $normalChars, $str);
        
        // Boşlukları temizle
        $str = trim($str);
        
        return $str;
    }

    // 
    public function _checkRepairPlaceIfFull($data, $entityManager, $request)
    {
        // Ajax ile gönderilen repairPlace idsini alamadığım için idyi request ile alıyorum.
        $repairPlace = $request->request->all()['service_info']['repairPlace'];
        $repairDate = $data->getRepairDate();
        
        $foundData = $entityManager->getRepository(ServiceInfo::class)->findOneBy([
            'repairPlace' => $repairPlace,
            'repairDate' => $repairDate
        ]);

        if ($foundData) {
            return true;
        }
        return false;
    }
}
