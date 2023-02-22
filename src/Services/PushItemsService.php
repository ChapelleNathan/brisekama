<?php

namespace App\Services;

use App\Entity\Ingredient;
use App\Entity\Item;
use App\Entity\Statistic;
use App\Repository\RuneRepository;
use Doctrine\ORM\EntityManagerInterface;

class PushItemsService
{
    public array $itemTypes;
    public array $runes;
    public EntityManagerInterface $manager;
    private array $statNames;

    public function __construct(CallDofApiService $callDofApiService, RuneRepository $runeRepository, EntityManagerInterface $manager) {
        $this->runes = $runeRepository->findAll();
        $this->itemTypes = $callDofApiService->getItems();
        $this->manager = $manager;
        foreach ($this->runes as $rune ) {
            $this->statNames[] = $rune->getStatistic();
        }
    }

    public function bddConverter()
    {
        foreach ($this->itemTypes as $item) {
            $newItem = new Item();
            $newItem->setAnkamaId($item['ankamaId']);
            $newItem->setName($item['name']);
            $newItem->setLevel($item['level']);
            $newItem->setType($item['type']);
            $newItem->setImgUrl($item['imgUrl']);
            $newItem->setUrl($item['url']);
            foreach ($item['statistics'] as $statistics) {
                if(array_search(key($statistics), $this->statNames)){
                    foreach ($statistics as $statistic) {
                            $newStatistic = new Statistic();
                            $newStatistic->setName(key($statistics));
                            foreach ($this->runes as $rune) {
                                if ($rune->getStatistic() === $newStatistic->getName()) {
                                    $newStatistic->setRune($rune);
                                }
                            }
                            $statistic['max'] ? $newStatistic->setValue($statistic['max']) : $newStatistic->setValue($statistic['min']);
                            if($newStatistic->getRune()){
                                $newItem->addStatistic($newStatistic);
                            }
                            $this->manager->persist($newStatistic);
                        
                    }
                }
            }
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
            dump($newItem);
            $this->manager->persist($newItem);
        }
        $this->manager->flush();
    }
}