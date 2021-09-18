<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phaseSeed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $point;

    /**
     * @ORM\OneToMany(targetEntity=UserCollectible::class, mappedBy="user", orphanRemoval=true)
     */
    private $userCollectibles;

    /**
     * @ORM\OneToMany(targetEntity=UserMarket::class, mappedBy="user", orphanRemoval=true)
     */
    private $userMarkets;

    /**
     * @ORM\OneToMany(targetEntity=UserMission::class, mappedBy="user", orphanRemoval=true)
     */
    private $userMissions;

    /**
     * @ORM\OneToMany(targetEntity=Market::class, mappedBy="owner", orphanRemoval=true)
     */
    private $markets;

    public function __construct()
    {
        $this->collectible = new ArrayCollection();
        $this->userCollectibles = new ArrayCollection();
        $this->userMarkets = new ArrayCollection();
        $this->userMissions = new ArrayCollection();
        $this->markets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getPhaseSeed(): ?string
    {
        return $this->phaseSeed;
    }

    public function setPhaseSeed(string $phaseSeed): self
    {
        $this->phaseSeed = $phaseSeed;

        return $this;
    }

    public function getPoint(): ?int
    {
        return $this->point;
    }

    public function setPoint(?int $point): self
    {
        $this->point = $point;

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
            $userCollectible->setUser($this);
        }

        return $this;
    }

    public function removeUserCollectible(UserCollectible $userCollectible): self
    {
        if ($this->userCollectibles->removeElement($userCollectible)) {
            // set the owning side to null (unless already changed)
            if ($userCollectible->getUser() === $this) {
                $userCollectible->setUser(null);
            }
        }

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
            $userMarket->setUser($this);
        }

        return $this;
    }

    public function removeUserMarket(UserMarket $userMarket): self
    {
        if ($this->userMarkets->removeElement($userMarket)) {
            // set the owning side to null (unless already changed)
            if ($userMarket->getUser() === $this) {
                $userMarket->setUser(null);
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
            $userMission->setUser($this);
        }

        return $this;
    }

    public function removeUserMission(UserMission $userMission): self
    {
        if ($this->userMissions->removeElement($userMission)) {
            // set the owning side to null (unless already changed)
            if ($userMission->getUser() === $this) {
                $userMission->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Market[]
     */
    public function getMarkets(): Collection
    {
        return $this->markets;
    }

    public function addMarket(Market $market): self
    {
        if (!$this->markets->contains($market)) {
            $this->markets[] = $market;
            $market->setOwner($this);
        }

        return $this;
    }

    public function removeMarket(Market $market): self
    {
        if ($this->markets->removeElement($market)) {
            // set the owning side to null (unless already changed)
            if ($market->getOwner() === $this) {
                $market->setOwner(null);
            }
        }

        return $this;
    }
}
