<?php

namespace App\Entity;

use App\Repository\MarketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarketRepository::class)
 */
class Market
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $collection;

    /**
     * @ORM\OneToOne(targetEntity=Collectible::class, inversedBy="market", cascade={"persist", "remove"})
     */
    private $item;

    /**
     * @ORM\OneToMany(targetEntity=UserMarket::class, mappedBy="market", orphanRemoval=true)
     */
    private $userMarkets;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="markets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function __construct()
    {
        $this->userMarkets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCollection(): ?string
    {
        return $this->collection;
    }

    public function setCollection(string $collection): self
    {
        $this->collection = $collection;

        return $this;
    }

    public function getItem(): ?Collectible
    {
        return $this->item;
    }

    public function setItem(?Collectible $item): self
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @return Collection|UserMarket[]
     */
    public function getUserMarkets(): Collection
    {
        return $this->userMarkets;
    }

    public function addUserMarket(UserMarket $userMarket): self
    {
        if (!$this->userMarkets->contains($userMarket)) {
            $this->userMarkets[] = $userMarket;
            $userMarket->setMarket($this);
        }

        return $this;
    }

    public function removeUserMarket(UserMarket $userMarket): self
    {
        if ($this->userMarkets->removeElement($userMarket)) {
            // set the owning side to null (unless already changed)
            if ($userMarket->getMarket() === $this) {
                $userMarket->setMarket(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

}
