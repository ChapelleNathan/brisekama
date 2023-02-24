<?php

namespace App\Entity;

use App\Repository\RuneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RuneRepository::class)]
class Rune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(nullable:true)]
    private ?int $price = null;

    #[ORM\Column]
    private ?int $weight = null;

    #[ORM\Column(length: 50)]
    private ?string $statistic = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getStatistic(): ?string
    {
        return $this->statistic;
    }

    public function setStatistic(string $statistic): self
    {
        $this->statistic = $statistic;

        return $this;
    }
}
