<?php

namespace App\Controller\Api;

use App\Entity\UserMission;
use App\Exception\Api\ContentEmptyException;
use App\Exception\Api\ServerException;
use App\Repository\MissionRepository;
use App\Repository\UserMissionRepository;
use App\Service\Mission\MissionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;

class MissionController extends AbstractApiController
{
    private $missionService;
    private $missionRepo;
    private $userMissionRepo;
    private $em;

    public function __construct(
        MissionService $missionService,
        MissionRepository $missionRepository,
        UserMissionRepository $userMissionRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->missionService  = $missionService;
        $this->missionRepo     = $missionRepository;
        $this->userMissionRepo = $userMissionRepository;
        $this->em              = $entityManager;
    }

    /**
     * @Route("/api/mission/{id}", name="api_mission_detail", methods={"GET"})
     */
    public function index($id)
    {
        $mission = $this->missionRepo->findOneBy(['id' => $id]);

        if (empty($mission)) {
            return $this->jsonError('Not found');
        }

        return $this->jsonSuccess([
            'title' => $mission->getTitle(),
            'description' => $mission->getDescription(),
            'order' => $mission->getDefaultOrder()
        ]);
    }

    /**
     * @Route("/api/mission/completed", name="api_mission_completed", methods={"POST"})
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function completedMission(Request $request)
    {
        try {
            $data = $this->getJsonData($request);
        } catch (ContentEmptyException | ServerException $e) {
            return $this->jsonError('Not found');
        }
        $userMission = $this->userMissionRepo->getMissionOfUser($data['uid'], $data['mission']);
        if (empty($userMission)) {
            return $this->jsonError('Not found');
        }

        if ($userMission instanceof UserMission) {
            $completedAt = new \DateTime();
            $userMission->setCompeletedAt($completedAt);
            $this->em->persist($userMission);
            $this->em->flush();

            return $this->jsonSuccess();
        }

        return $this->jsonError('Not found');
    }
}
