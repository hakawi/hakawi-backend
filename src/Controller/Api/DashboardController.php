<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/api/dashboard", name="api_dashboard")
     */
    public function index(): Response
    {
        return $this->render('api/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
