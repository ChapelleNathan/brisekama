<?php

namespace App\Entity;

use App\Repository\ItemServerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemServerRepository::class)]
class ItemServer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itemServers')]
    #[ORM\JoinColumn(name: 'item_id', referencedColumnName: 'id', nullable: false)]
    private ?Item $item = null;

    #[ORM\ManyToOne(inversedBy: 'itemServers')]
    #[ORM\JoinColumn(name: 'server_id', referencedColumnName: 'id', nullable: false)]
    private ?Server $server = null;

    #[ORM\Column]
    private ?int $percentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getServer(): ?Server
    {
        return $this->server;
    }

    public function setServer(?Server $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }
}
