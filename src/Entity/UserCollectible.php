<?php

namespace App\Entity;

use App\Repository\UserCollectibleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserCollectibleRepository::class)
 */
class UserCollectible
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $position = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userCollectibles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Collectible::class, inversedBy="userCollectibles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectible;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?array
    {
        return $this->position;
    }

    public function setPosition(?array $position): self
    {
        $this->position = $position;

        return $this;
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
