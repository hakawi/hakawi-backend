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

    // /**
    //  * @return UserMarket[] Returns an array of UserMarket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserMarket
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
