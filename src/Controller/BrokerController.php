<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use App\Services\PushItemsService;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'app_broker')]
    public function index(PushItemsService $t, ItemRepository $itemRepository): Response
    {
        $items = $itemRepository->findAll();
        $statistics = [];
        $ingredients = [];
        foreach ($items[0]->getStatistic() as $stats ) {
            $statistics[] = $stats;
        }
        foreach ($items[0]->getIngredient() as $stats ) {
            $ingredients[] = $stats;
        }
        dd($items[0],$statistics,$ingredients);
        //$t->bddConverter();
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'items' => $items,
        ]);
    }
}
