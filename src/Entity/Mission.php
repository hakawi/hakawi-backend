<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=UserMission::class, mappedBy="mission", orphanRemoval=true)
     */
    private $userMissions;

    public function __construct()
    {
        $this->userMissions = new ArrayCollection();
    }

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
            $userMission->setMission($this);
        }

        return $this;
    }

    public function removeUserMission(UserMission $userMission): self
    {
        if ($this->userMissions->removeElement($userMission)) {
            // set the owning side to null (unless already changed)
            if ($userMission->getMission() === $this) {
                $userMission->setMission(null);
            }
        }

        return $this;
    }

}
