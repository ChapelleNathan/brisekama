<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'server', targetEntity: ItemServer::class)]
    private Collection $itemServers;

    public function __construct()
    {
        $this->itemServers = new ArrayCollection();
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
            $itemServer->setServer($this);
        }

        return $this;
    }

    public function removeItemServer(ItemServer $itemServer): self
    {
        if ($this->itemServers->removeElement($itemServer)) {
            // set the owning side to null (unless already changed)
            if ($itemServer->getServer() === $this) {
                $itemServer->setServer(null);
            }
        }

        return $this;
    }
}
