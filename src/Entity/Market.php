<?php

namespace App\Entity;

use App\Repository\MarketRepository;
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
     * @ORM\OneToOne(targetEntity=UserMarket::class, mappedBy="market", cascade={"persist", "remove"})
     */
    private $userMarket;

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

    public function getUserMarket(): ?UserMarket
    {
        return $this->userMarket;
    }

    public function setUserMarket(UserMarket $userMarket): self
    {
        // set the owning side of the relation if necessary
        if ($userMarket->getMarket() !== $this) {
            $userMarket->setMarket($this);
        }

        $this->userMarket = $userMarket;

        return $this;
    }
}
