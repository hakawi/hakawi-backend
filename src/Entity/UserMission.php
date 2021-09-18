<?php

namespace App\Entity;

use App\Repository\UserMissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserMissionRepository::class)
 */
class UserMission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Mission::class, inversedBy="userMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mission;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $compeleted_at;

    /**
     * @ORM\ManyToOne(targetEntity=Collectible::class, inversedBy="userMissions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectible;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }

    public function getCompeletedAt(): ?\DateTimeInterface
    {
        return $this->compeleted_at;
    }

    public function setCompeletedAt(\DateTimeInterface $compeleted_at): self
    {
        $this->compeleted_at = $compeleted_at;

        return $this;
    }

    public function getCollectible(): ?Collectible
    {
        return $this->collectible;
    }

    public function setCollectible(?Collectible $collectible): self
    {
        $this->collectible = $collectible;

        return $this;
    }


}
