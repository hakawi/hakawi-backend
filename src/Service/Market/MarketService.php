<?php

namespace App\Service\Market;

use App\Repository\UserMarketRepository;
use Doctrine\ORM\EntityManagerInterface;

class MarketService
{
    private $entityManager;
    private $userMarketRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserMarketRepository $userMarketRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->userMarketRepository = $userMarketRepository;
    }

    public function getByUser($uid)
    {
        return $this->userMarketRepository->getAllMarketOfUser($uid);
    }
}