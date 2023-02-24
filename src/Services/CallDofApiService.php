<?php

namespace App\Services;

use Doctrine\Migrations\Configuration\Migration\JsonFile;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallDofApiService 
{
    private $client;
    private $itemsJSON;
    private $weaponsJSON;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function fetchItems(): string
    {
        //TODO when finished with bdd, try with all items and not with one
        $response = $this->client->request(
            'GET',
            'https://fr.dofus.dofapi.fr/equipments'
        );
       return $this->itemsJSON = $response->getContent();
    }

    private function fetchWeapons(): string
    {
        //TODO when finished with bdd, try with all weapons and not with one
        $response = $this->client->request(
            'GET',
            'https://fr.dofus.dofapi.fr/weapons'
        );

        return $this->weaponsJSON = $response->getContent();
    }

    public function getItems(): array
    {
        $items = json_decode($this->fetchItems(), true);
        $weapons = json_decode($this->fetchWeapons(), true);
        $allItems = ['items' => $items, 'weapons' => $weapons];
        return $allItems;
    }
}