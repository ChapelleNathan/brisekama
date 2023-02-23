<?php

namespace App\Services;

use App\Entity\Ingredient;
use App\Entity\Item;
use App\Entity\ItemStatistic;
use App\Entity\Statistic;
use App\Repository\RuneRepository;
use App\Repository\StatisticRepository;
use Doctrine\ORM\EntityManagerInterface;

class ItemService
{
    public array $itemTypes;
    public EntityManagerInterface $manager;
    private $statistics;

    public function __construct(CallDofApiService $callDofApiService, StatisticRepository $statisticRepository, EntityManagerInterface $manager) {
        $this->statistics = $statisticRepository->findAll();
        $this->itemTypes = $callDofApiService->getItems();
        $this->manager = $manager;
    }

    public function dbConverter()
    {
        foreach ($this->itemTypes as $item) {
            $newItem = new Item();
            $newItem->setAnkamaId($item['ankamaId']);
            $newItem->setName($item['name']);
            $newItem->setLevel($item['level']);
            $newItem->setType($item['type']);
            $newItem->setImgUrl($item['imgUrl']);
            $newItem->setUrl($item['url']);
            foreach ($item['statistics'] as $itemStat) {
                foreach ($this->statistics as $statistic) {
                    if ($statistic->getName() === key($itemStat)) {
                        $newItemStat = new ItemStatistic();
                        $newItemStat->setStatistic($statistic);
                        $newItemStat->setItem($newItem);
                        $itemStat[$statistic->getName()]['max'] ? $quantity = $itemStat[$statistic->getName()]['max'] : $quantity = $itemStat[$statistic->getName()]['min'];
                        $newItemStat->setQuantity($quantity);
                        $this->manager->persist($newItemStat);
                        $newItem->addItemStatistic($newItemStat);
                    }
                }
            }
            ;
            foreach ($item['recipe'] as $ingredients) {
                foreach ($ingredients as $ingredient) {
                    $newIngredient = new Ingredient();
                    $newIngredient->setAnkamaId($ingredient['ankamaId']);
                    $newIngredient->setImgUrl($ingredient['imgUrl']);
                    $newIngredient->setQuantity($ingredient['quantity']);
                    $newIngredient->setName(key($ingredients));
                    $newItem->addIngredient($newIngredient);
                    $this->manager->persist($newIngredient);
                }
            }
            $this->manager->persist($newItem);
        }
        $this->manager->flush();
    }
}