<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\SearchItemType;
use App\Repository\ItemRepository;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'broker')]
    public function index(ItemRepository $itemRepository, ServerRepository $serverRepository, Request $request): Response
    {
        $item = new Item();
        $form = $this->createForm(SearchItemType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $item = $datas['search'];
        }
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'item' => $item,
            'servers' => $serverRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}
