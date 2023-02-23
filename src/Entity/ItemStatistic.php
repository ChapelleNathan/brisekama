<?php

namespace App\Entity;

use App\Repository\ItemStatisticRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemStatisticRepository::class)]
class ItemStatistic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'itemStatistics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Item $item = null;

    #[ORM\ManyToOne(inversedBy: 'itemStatistics')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Statistic $statistic = null;

    #[ORM\Column]
    private ?int $quantity = null;

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

    public function getStatistic(): ?Statistic
    {
        return $this->statistic;
    }

    public function setStatistic(?Statistic $statistic): self
    {
        $this->statistic = $statistic;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
