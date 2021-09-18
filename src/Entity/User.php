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
     * @ORM\Column(type="string", length=255)
     */
    private $uid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phaseSeed;

    /**
     * @ORM\OneToOne(targetEntity=UserCollectible::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userCollectible;

    /**
     * @ORM\OneToOne(targetEntity=UserMarket::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userMarket;

    /**
     * @ORM\OneToOne(targetEntity=UserMission::class, mappedBy="user", cascade={"persist", "remove"})
     */
    private $userMission;

    public function __construct()
    {
        $this->collectible = new ArrayCollection();
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

    public function getUserCollectible(): ?UserCollectible
    {
        return $this->userCollectible;
    }

    public function setUserCollectible(UserCollectible $userCollectible): self
    {
        // set the owning side of the relation if necessary
        if ($userCollectible->getUser() !== $this) {
            $userCollectible->setUser($this);
        }

        $this->userCollectible = $userCollectible;

        return $this;
    }

    public function getUserMarket(): ?UserMarket
    {
        return $this->userMarket;
    }

    public function setUserMarket(UserMarket $userMarket): self
    {
        // set the owning side of the relation if necessary
        if ($userMarket->getUser() !== $this) {
            $userMarket->setUser($this);
        }

        $this->userMarket = $userMarket;

        return $this;
    }

    public function getUserMission(): ?UserMission
    {
        return $this->userMission;
    }

    public function setUserMission(UserMission $userMission): self
    {
        // set the owning side of the relation if necessary
        if ($userMission->getUser() !== $this) {
            $userMission->setUser($this);
        }

        $this->userMission = $userMission;

        return $this;
    }
}
