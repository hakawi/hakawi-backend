<?php

namespace App\Repository;

use App\Entity\UserMission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserMission|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserMission|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserMission[]    findAll()
 * @method UserMission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserMissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserMission::class);
    }

    public function getAllMissionOfUser($uid)
    {
        return $this->createQueryBuilder('uc')
                    ->join('uc.user', 'u')
                    ->join('um.mission', 'm')
                    ->where('u.uid = :uid')
                    ->setParameter('uid', $uid)
                    ->getQuery()
                    ->getResult();
    }
}
