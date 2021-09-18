<?php

namespace App\Repository;

use App\Entity\UserCollectible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserCollectible|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCollectible|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCollectible[]    findAll()
 * @method UserCollectible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCollectibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCollectible::class);
    }

    public function getAllCollectibleOfUser($uid)
    {
        return $this->createQueryBuilder('uc')
            ->join('uc.user', 'u')
            ->join('uc.collectible', 'c')
            ->where('u.uid = :uid')
            ->setParameter('uid', $uid)
            ->getQuery()
            ->getResult();
    }
}
