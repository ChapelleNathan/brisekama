<?php

namespace App\Controller;

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
        $form = $this->createForm(SearchItemType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();

            $search = $datas['search'];

            $items = $itemRepository->searchByName($search);
            dump($items);
        }
        $servers = $serverRepository->findAll();
        $lastItem = $itemRepository->findOneBy([],['id' => 'DESC']);
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'lastItem' => $lastItem,
            'servers' => $servers,
            'form' => $form->createView(),
        ]);
    }
}
