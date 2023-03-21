<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\ItemServer;
use App\Entity\Server;
use App\Form\BrokerType;
use App\Form\ItemPercentageType;
use App\Form\SearchItemType;
use App\Repository\ItemRepository;
use App\Repository\ItemServerRepository;
use App\Repository\ServerRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'broker')]
    public function index(
        ServerRepository $serverRepository,
        Request $request,
        ItemServerRepository $itemServerRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        $item = new Item();
        $form = $this->createForm(BrokerType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $search = $datas['searchType'];
            $percentage = $datas['percentageType'];
            $item = $search['search'];
            $server = $search['server'];
            if ($percentage['serverId'] !== null || $percentage['itemId'] !== null) {
                $serverItem = $itemServerRepository->getOneByItemServerIds($percentage['serverId'], $percentage['itemId']);
                $serverItem->setPercentage($percentage['percentage']);
                $entityManager->flush();
            } 
            $content = $this->renderView('broker/index.html.twig', [
                'controller_name' => 'BrokerController',
                'item' => $item,
                'server' => $server,
                'form' => $form->createView(),
            ]);
            return new Response($content, Response::HTTP_SEE_OTHER);
        }

        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'item' => $item,
            'server' => $serverRepository->getFirstServer(),
            'form' => $form->createView(),
        ]);
    }
}
