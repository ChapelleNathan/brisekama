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

    #[ORM\ManyToMany(targetEntity: Ingredient::class)]
    private Collection $ingredient;

    #[ORM\ManyToMany(targetEntity: Server::class, mappedBy: 'item')]
    private Collection $servers;

    #[ORM\OneToMany(mappedBy: 'item', targetEntity: ItemStatistic::class, orphanRemoval: true)]
    private Collection $itemStatistics;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
        $this->servers = new ArrayCollection();
        $this->itemStatistics = new ArrayCollection();
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
     * @return Collection<int, Ingredient>
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection<int, Server>
     */
    public function getServers(): Collection
    {
        return $this->servers;
    }

    public function addServer(Server $server): self
    {
        if (!$this->servers->contains($server)) {
            $this->servers->add($server);
            $server->addItem($this);
        }

        return $this;
    }

    public function removeServer(Server $server): self
    {
        if ($this->servers->removeElement($server)) {
            $server->removeItem($this);
        }

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
}
