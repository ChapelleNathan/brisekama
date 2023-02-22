<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallDofApiService 
{
    private $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function fetchItems(): array
    {
        //TODO when finished with bdd, try with all items and not with one
        $response = $this->client->request(
            'GET',
            'https://fr.dofus.dofapi.fr/equipments/70'
        );
       return $response->toArray();
    }

    public function fetchWeapons():array
    {
        //TODO when finished with bdd, try with all weapons and not with one
        $response = $this->client->request(
            'GET',
            'https://fr.dofus.dofapi.fr/weapons/44'
        );

        return $response->toArray();
    }
}