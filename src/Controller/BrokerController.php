<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\ItemServer;
use App\Entity\Server;
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
        $form = $this->createForm(SearchItemType::class);
        $form->handleRequest($request);
        $percentage = $this->createForm(ItemPercentageType::class);


        if ($form->isSubmitted() && $form->isValid()) {
            $datas = $form->getData();
            $item = $datas['search'];
            $server = $datas['server'];
            $content = $this->renderView('broker/index.html.twig', [
                'controller_name' => 'BrokerController',
                'item' => $item,
                'server' => $server,
                'form' => $form->createView(),
                'percentage' => $percentage->createView(),
            ]);
            return new Response($content, Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            $response = new Response;
            $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            return $this->render(
                'broker/index.html.twig',
                [
                    'controller_name' => 'BrokerController',
                    'item' => $item,
                    'server' => $serverRepository->getFirstServer(),
                    'form' => $form->createView(),
                    'percentage' => $percentage->createView(),
                ],
                $response
            );
        }

        $percentage->handleRequest($request);

        if ($percentage->isSubmitted() && $percentage->isValid()) {
            dd('toto');
            $datas = $percentage->getData();
            $serverId = $datas['serverId'];
            $itemId = $datas['itemId'];
            $itemServer = $itemServerRepository->getOneByItemServerIds($serverId, $itemId);
            $itemServer->setPercentage($datas['percentage']);
            $entityManager->flush();

            $content = $this->renderView('broker/index.html.twig', [
                'controller_name' => 'BrokerController',
                'item' => $item,
                'server' => $serverRepository->getFirstServer(),
                'form' => $form->createView(),
                'percentage' => $percentage->createView(),
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
