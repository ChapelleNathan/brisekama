<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ankama_id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $imgUrl = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemStatistic::class, orphanRemoval: true)]
    private Collection $itemStatistics;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemIngredient::class, orphanRemoval: true)]
    private Collection $itemIngredients;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemServer::class, orphanRemoval: true)]
    private Collection $itemServers;

    public function __construct()
    {
        $this->itemStatistics = new ArrayCollection();
        $this->itemIngredients = new ArrayCollection();
        $this->itemServers = new ArrayCollection();
    }

    public function __toString():string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnkamaId(): ?int
    {
        return $this->ankama_id;
    }

    public function setAnkamaId(int $ankama_id): self
    {
        $this->ankama_id = $ankama_id;

        return $this;
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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
            $itemStatistic->setItem($this);
        }

        return $this;
    }

    public function removeItemStatistic(ItemStatistic $itemStatistic): self
    {
        if ($this->itemStatistics->removeElement($itemStatistic)) {
            // set the owning side to null (unless already changed)
            if ($itemStatistic->getItem() === $this) {
                $itemStatistic->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemIngredient>
     */
    public function getItemIngredients(): Collection
    {
        return $this->itemIngredients;
    }

    public function addItemIngredient(ItemIngredient $itemIngredient): self
    {
        if (!$this->itemIngredients->contains($itemIngredient)) {
            $this->itemIngredients->add($itemIngredient);
            $itemIngredient->setItem($this);
        }

        return $this;
    }

    public function removeItemIngredient(ItemIngredient $itemIngredient): self
    {
        if ($this->itemIngredients->removeElement($itemIngredient)) {
            // set the owning side to null (unless already changed)
            if ($itemIngredient->getItem() === $this) {
                $itemIngredient->setItem(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemServer>
     */
    public function getItemServers(): Collection
    {
        return $this->itemServers;
    }

    public function addItemServer(ItemServer $itemServer): self
    {
        if (!$this->itemServers->contains($itemServer)) {
            $this->itemServers->add($itemServer);
            $itemServer->setItem($this);
        }

        return $this;
    }

    public function removeItemServer(ItemServer $itemServer): self
    {
        if ($this->itemServers->removeElement($itemServer)) {
            // set the owning side to null (unless already changed)
            if ($itemServer->getItem() === $this) {
                $itemServer->setItem(null);
            }
        }

        return $this;
    }
}
