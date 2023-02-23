<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use App\Repository\ItemRepository;
use App\Services\ItemService;
use App\Services\PushItemsService;
use App\Services\StatisticService;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrokerController extends AbstractController
{
    #[Route('/broker', name: 'app_broker')]
    public function index(ItemService $i, ItemRepository $t, IngredientRepository $s): Response
    {
        //$i->dbConverter($s);
        $items = $t->findAll();
        return $this->render('broker/index.html.twig', [
            'controller_name' => 'BrokerController',
            'items' => $items,
        ]);
    }
}
