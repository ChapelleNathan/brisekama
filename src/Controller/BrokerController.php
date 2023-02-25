<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'broker')]
    public function index(ItemRepository $itemRepository, ServerRepository $serverRepository): Response
    {
        $servers = $serverRepository->findAll();
        $lastItem = $itemRepository->findOneBy([],['id' => 'DESC']);
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'lastItem' => $lastItem,
            'servers' => $servers,
        ]);
    }
}
