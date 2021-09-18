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
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userMission", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Mission::class, inversedBy="userMission", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Mission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->Mission;
    }

    public function setMission(Mission $Mission): self
    {
        $this->Mission = $Mission;

        return $this;
    }
}
