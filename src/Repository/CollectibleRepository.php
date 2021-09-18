<?php

namespace App\Repository;

use App\Entity\Collectible;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Collectible|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collectible|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collectible[]    findAll()
 * @method Collectible[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectibleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collectible::class);
    }


}
