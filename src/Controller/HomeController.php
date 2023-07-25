<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/index', name: 'app_home')]
    public function index(Request $request): Response
    {
        
        if ($request->isXmlHttpRequest()) 
        {
            // $customer = new Customer;
            dd($request->request->all());

        }

        return $this->render('home/index.html.twig', [
            'name' => 'alionur',
        ]);
    }

}
