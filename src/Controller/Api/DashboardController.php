<?php

namespace App\Controller\Api;

use App\Service\User\UserDashboardService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractApiController
{
    private $userDashboard;
    public function __construct(
        UserDashboardService $userDashboard
    )
    {
        $this->userDashboard = $userDashboard;
    }

    /**
     * @Route("/api/dashboard", name="api_dashboard")
     */
    public function index(): Response
    {
        return $this->render('api/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    /**
     * @Route("/api/dashboard/{uid}", name="api_dashboard_user")
     */
    public function getDashboardUser($uid): Response
    {
        return $this->jsonSuccess($this->userDashboard->getByUid($uid));
    }
}
