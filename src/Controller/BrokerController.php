<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'app_broker')]
    public function index(): Response
    {
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
        ]);
    }
}
