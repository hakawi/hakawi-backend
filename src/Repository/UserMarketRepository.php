<?php

namespace App\Repository;

use App\Entity\UserMarket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserMarket|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMarket|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMarket[]    findAll()
 * @method UserMarket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMarketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMarket::class);
    }

    public function getAllMarketOfUser($uid)
    {
        return $this->createQueryBuilder('uc')
                    ->join('uc.user', 'u')
                    ->join('uc.market', 'm')
                    ->where('u.uid = :uid')
                    ->setParameter('uid', $uid)
                    ->getQuery()
                    ->getResult();
    }
}
