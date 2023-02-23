<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $ankama_id = null;

    #[ORM\Column(length: 255)]
    private ?string $imgUrl = null;


    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: ItemIngredient::class, orphanRemoval: true)]
    private Collection $itemIngredients;

    public function __construct()
    {
        $this->itemIngredients = new ArrayCollection();
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

    public function getImgUrl(): ?string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;

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
            $itemIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeItemIngredient(ItemIngredient $itemIngredient): self
    {
        if ($this->itemIngredients->removeElement($itemIngredient)) {
            // set the owning side to null (unless already changed)
            if ($itemIngredient->getIngredient() === $this) {
                $itemIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
