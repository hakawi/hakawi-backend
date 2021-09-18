<?php

namespace App\Entity;

use App\Repository\CollectibleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=UserCollectible::class, mappedBy="collectible", orphanRemoval=true)
     */
    private $userCollectibles;

    /**
     * @ORM\OneToMany(targetEntity=UserMission::class, mappedBy="collectible", orphanRemoval=true)
     */
    private $userMissions;

    public function __construct()
    {
        $this->userCollectibles = new ArrayCollection();
        $this->userMissions = new ArrayCollection();
    }

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

    /**
     * @return Collection|UserCollectible[]
     */
    public function getUserCollectibles(): Collection
    {
        return $this->userCollectibles;
    }

    public function addUserCollectible(UserCollectible $userCollectible): self
    {
        if (!$this->userCollectibles->contains($userCollectible)) {
            $this->userCollectibles[] = $userCollectible;
            $userCollectible->setCollectible($this);
        }

        return $this;
    }

    public function removeUserCollectible(UserCollectible $userCollectible): self
    {
        if ($this->userCollectibles->removeElement($userCollectible)) {
            // set the owning side to null (unless already changed)
            if ($userCollectible->getCollectible() === $this) {
                $userCollectible->setCollectible(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserMission[]
     */
    public function getUserMissions(): Collection
    {
        return $this->userMissions;
    }

    public function addUserMission(UserMission $userMission): self
    {
        if (!$this->userMissions->contains($userMission)) {
            $this->userMissions[] = $userMission;
            $userMission->setCollectible($this);
        }

        return $this;
    }

    public function removeUserMission(UserMission $userMission): self
    {
        if ($this->userMissions->removeElement($userMission)) {
            // set the owning side to null (unless already changed)
            if ($userMission->getCollectible() === $this) {
                $userMission->setCollectible(null);
            }
        }

        return $this;
    }
}
