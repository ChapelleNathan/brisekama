<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticRepository::class)]
class Statistic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rune $rune = null;

    #[ORM\OneToMany(mappedBy: 'statistic', targetEntity: ItemStatistic::class, orphanRemoval: true)]
    private Collection $itemStatistics;

    public function __construct()
    {
        $this->itemStatistics = new ArrayCollection();
    }

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

    public function getRune(): ?Rune
    {
        return $this->rune;
    }

    public function setRune(Rune $rune): self
    {
        $this->rune = $rune;

        return $this;
    }

    /**
     * @return Collection<int, ItemStatistic>
     */
    public function getItemStatistics(): Collection
    {
        return $this->itemStatistics;
    }

    public function addItemStatistic(ItemStatistic $itemStatistic): self
    {
        if (!$this->itemStatistics->contains($itemStatistic)) {
            $this->itemStatistics->add($itemStatistic);
            $itemStatistic->setStatistic($this);
        }

        return $this;
    }

    public function removeItemStatistic(ItemStatistic $itemStatistic): self
    {
        if ($this->itemStatistics->removeElement($itemStatistic)) {
            // set the owning side to null (unless already changed)
            if ($itemStatistic->getStatistic() === $this) {
                $itemStatistic->setStatistic(null);
            }
        }

        return $this;
    }
}
