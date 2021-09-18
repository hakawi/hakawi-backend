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

    // /**
    //  * @return UserCollectible[] Returns an array of UserCollectible objects
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
    public function findOneBySomeField($value): ?UserCollectible
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
