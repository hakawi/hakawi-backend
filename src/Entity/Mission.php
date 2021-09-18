<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
class Mission
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaultOrder;

    /**
     * @ORM\OneToOne(targetEntity=UserMission::class, mappedBy="Mission", cascade={"persist", "remove"})
     */
    private $userMission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDefaultOrder(): ?int
    {
        return $this->defaultOrder;
    }

    public function setDefaultOrder(?int $defaultOrder): self
    {
        $this->defaultOrder = $defaultOrder;

        return $this;
    }

    public function getUserMission(): ?UserMission
    {
        return $this->userMission;
    }

    public function setUserMission(UserMission $userMission): self
    {
        // set the owning side of the relation if necessary
        if ($userMission->getMission() !== $this) {
            $userMission->setMission($this);
        }

        $this->userMission = $userMission;

        return $this;
    }
}
