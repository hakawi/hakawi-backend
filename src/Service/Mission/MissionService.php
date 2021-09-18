<?php

namespace App\Service\Mission;

use App\Repository\UserMissionRepository;
use Doctrine\ORM\EntityManagerInterface;

class MissionService
{
    private $entityManager;
    private $userMissionRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserMissionRepository $userMissionRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->userMissionRepository = $userMissionRepository;
    }

    public function getByUser($uid)
    {
        return $this->userMissionRepository->getAllMissionOfUser($uid);
    }
}