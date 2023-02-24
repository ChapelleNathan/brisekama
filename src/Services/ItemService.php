<?php

namespace App\Services;

use App\Entity\Ingredient;
use App\Entity\Item;
use App\Entity\ItemIngredient;
use App\Entity\ItemStatistic;
use App\Entity\Statistic;
use App\Repository\IngredientRepository;
use App\Repository\RuneRepository;
use App\Repository\StatisticRepository;
use Doctrine\ORM\EntityManagerInterface;

class ItemService
{
    public array $itemTypes;
    public EntityManagerInterface $manager;
    private $statistics;
    private $ingredientsArray;
    private IngredientRepository $ingredientRepository;

    public function __construct(
        CallDofApiService $callDofApiService,
        StatisticRepository $statisticRepository,
        EntityManagerInterface $manager,
        IngredientRepository $ingredientRepository,
        ) {
        $this->ingredientsArray = $ingredientRepository->findAll();
        $this->statistics = $statisticRepository->findAll();
        $this->itemTypes = $callDofApiService->getItems();
        $this->manager = $manager;
    }

    public function dbConverter()
    {
        foreach ($this->itemTypes as $items) {
            foreach ($items as $item) {
                $newItem = new Item();          
                $newItem->setAnkamaId($item['ankamaId']);
                $newItem->setName($item['name']);
                $newItem->setLevel($item['level']);
                $newItem->setType($item['type']);
                $newItem->setImgUrl($item['imgUrl']);
                $newItem->setUrl($item['url']);
                if(array_key_exists('statistics',$item)){
                    foreach ($item['statistics'] as $itemStat) {
                        foreach ($this->statistics as $statistic) {
                            if ($statistic->getName() === key($itemStat) && $itemStat[$statistic->getName()]['min'] > 0) {
                                $newItemStat = new ItemStatistic();
                                $newItemStat->setStatistic($statistic);
                                $newItemStat->setItem($newItem);
                                $itemStat[$statistic->getName()]['max']
                                    ? $quantity = $itemStat[$statistic->getName()]['max']
                                    : $quantity = $itemStat[$statistic->getName()]['min'];
                                $newItemStat->setQuantity($quantity);
                                $this->manager->persist($newItemStat);
                                $newItem->addItemStatistic($newItemStat);
                            }
                        }
                    };
                }
                foreach ($item['recipe'] as $ingredients) {
                    foreach ($ingredients as $ingredient) {
                        $itemIngredient = new ItemIngredient();
                        $newItem->addItemIngredient($itemIngredient);
                        $itemIngredient->setItem($newItem);
                        $itemIngredient->setQuantity($ingredient['quantity']);
                        $ankama_ids = [];
                        foreach ($this->ingredientsArray as $ingredientsArray) {
                            $ankama_ids[] = $ingredientsArray->getAnkamaId();
                        }
                        if (!$this->ingredientsArray || !in_array($ingredient['ankamaId'], $ankama_ids)) {
                            $newIngredient = new Ingredient();
                            $newIngredient->setName(key($ingredients));
                            $newIngredient->setAnkamaId($ingredient['ankamaId']);
                            $newIngredient->setImgUrl($ingredient['imgUrl']);
                            $this->manager->persist($newIngredient);
            
                            $itemIngredient->setIngredient($newIngredient);
                        } else {
                            $fetchedIngredient = $this->ingredientRepository->findByAnkamaId($ingredient['ankamaId']);
                            $itemIngredient->setIngredient($fetchedIngredient[0]);
                        }
                        $this->manager->persist($itemIngredient);
                    }
                }
                $this->manager->persist($newItem);
            }
            $this->manager->flush();
            }
    }
}