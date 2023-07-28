<?php

namespace App\Controller;

use App\Entity\RepairPlace;
use App\Entity\RepairType;
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
    #[Route('/', name: 'app_home', methods: ['get', 'post'])]
    public function index(Request $request, ServiceInfoManager $serviceInfoManager): Response
    {
        $form = $this->createForm(ServiceInfoType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $data = $form->getData();
            $foundCustomer = $serviceInfoManager->_checkCustomerIfExist($data->getCustomer());

            if ($foundCustomer) {
                return $this->json([
                    'alert' => 'warning',
                    'message' => 'Bu müşteri kaydı zaten var.'
                ]);
            }

            $foundData = $serviceInfoManager->_checkRepairPlaceIfFull($data->getRepairDate(), $request->request->all()['service_info']['repairPlace']);

            if ($foundData) {
                return $this->json([
                    'alert' => 'warning',
                    'message' => 'Seçtiğiniz tamir tarihinde tamir yeri doludur.'
                ]);
            }


            $requestData = $request->request->all();
            $data->setVehicleModel($serviceInfoManager->_getDataFromRequest(VehicleModel::class, $requestData['service_info']['vehicleModel']));
            $data->setRepairPlace($serviceInfoManager->_getDataFromRequest(RepairPlace::class, $requestData['service_info']['repairPlace']));

            // kayıt işlemi için servisi çağırıyoruz
            $serviceInfoManager->create($data);

            return $this->json([
                'alert' => 'success',
                'message' => 'Form başarıyla kaydedildi.'
            ]);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /** 
     *   getvehiclemodels
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
}
