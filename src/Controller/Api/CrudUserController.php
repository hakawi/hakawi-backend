<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CrudUserController extends AbstractApiController
{
    /**
     * @Route("/api/user/", name="api_user_index")
     */
    public function index()
    {
        return $this->render('api/crud_user/index.html.twig', [
            'controller_name' => 'CrudUserController',
        ]);
    }

    /**
     * @Route("/api/user/create", name="api_user_create", methods={"POST"})
     */
    public function createUser(Request $request)
    {
        return $this->jsonSuccess();
    }

    /**
     * @Route("/api/user/{uid}", name="api_user_read", methods={"GET","HEAD"})
     */
    public function readUser(string $uid)
    {
        return $this->jsonSuccess();
    }

    /**
     * @Route("/api/user/{uid}/update", name="api_user_update", methods={"PUT"})
     */
    public function updateUser(string $uid, Request $request)
    {
        return $this->jsonSuccess();
    }

}
