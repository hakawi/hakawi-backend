<?php

namespace App\Service\Collectible;

use App\Repository\UserCollectibleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class CollectibleService
{

    private $entityManager;
    private $userCollectibleRepository;
    private $userRepo;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserCollectibleRepository $userCollectibleRepository,
        UserRepository $userRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->userCollectibleRepository = $userCollectibleRepository;
        $this->userRepo = $userRepository;
    }

    public function create($data)
    {

    }

    public function getByUser($uid)
    {
        return $this->userCollectibleRepository->getAllCollectibleOfUser($uid);
    }
}