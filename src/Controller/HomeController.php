<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\RepairPlace;
use App\Entity\RepairType;
use App\Entity\ServiceInfo;
use App\Entity\VehicleModel;
use App\Form\ServiceInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/index', name: 'app_home', methods: ['get','post'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(ServiceInfoType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            
            // ekleme işlemi olacak
            $data = $form->getData();

            $customer = new Customer;
            $customer->setName($data->getCustomer()->getName());
            $customer->setSurname($data->getCustomer()->getSurname());
            $customer->setPhoneNumber($data->getCustomer()->getPhoneNumber());

            $entityManager->persist($customer);

            $requestData = $request->request->all();
            $vehicleModelId = $requestData['service_info']['vehicleModel'];
            $repairPlaceId = $requestData['service_info']['repairPlace'];
            $vehicleModel = $entityManager->getRepository(VehicleModel::class)->find($vehicleModelId);
            $repairPlace = $entityManager->getRepository(RepairPlace::class)->find($repairPlaceId);
            // dd($vehicleModel);
            $serviceInfo = new ServiceInfo;
            $serviceInfo->setCustomer($customer);
            $serviceInfo->setVehicleBrand($data->getVehicleBrand());
            $serviceInfo->setVehicleModel($vehicleModel);
            $serviceInfo->setRepairDate($data->getRepairDate());
            $serviceInfo->setRepairType($data->getRepairType());
            $serviceInfo->setRepairPlace($repairPlace);

            $entityManager->persist($serviceInfo);
            $entityManager->flush();

            return $this->json([
                'message' => 'eklendi.'
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
}
