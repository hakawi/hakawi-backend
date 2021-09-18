<?php
namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $entityManager;
    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function create(array $data)
    {
        $user = new User();
        $user->setUid($data['uid']);
        $user->setPhaseSeed($data['phase_seed']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }

    public function update()
    {
        
    }
}