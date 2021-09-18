<?php

namespace App\Entity;

use App\Repository\CollectibleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectibleRepository::class)
 */
class Collectible
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
    private $url;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=Market::class, mappedBy="item", cascade={"persist", "remove"})
     */
    private $market;

    /**
     * @ORM\OneToOne(targetEntity=UserCollectible::class, mappedBy="collectible", cascade={"persist", "remove"})
     */
    private $userCollectible;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarket(): ?Market
    {
        return $this->market;
    }

    public function setMarket(?Market $market): self
    {
        // unset the owning side of the relation if necessary
        if ($market === null && $this->market !== null) {
            $this->market->setItem(null);
        }

        // set the owning side of the relation if necessary
        if ($market !== null && $market->getItem() !== $this) {
            $market->setItem($this);
        }

        $this->market = $market;

        return $this;
    }

    public function getUserCollectible(): ?UserCollectible
    {
        return $this->userCollectible;
    }

    public function setUserCollectible(UserCollectible $userCollectible): self
    {
        // set the owning side of the relation if necessary
        if ($userCollectible->getCollectible() !== $this) {
            $userCollectible->setCollectible($this);
        }

        $this->userCollectible = $userCollectible;

        return $this;
    }
}
