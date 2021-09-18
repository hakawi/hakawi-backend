<?php

namespace App\Controller\Api;

use App\Exception\Api\ContentEmptyException;
use App\Exception\Api\ServerException;
use App\Service\User\UserService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CrudUserController extends AbstractApiController
{
    private $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

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
        try {
            $data = $this->getJsonData($request);
            if ($data['uid'] || $data['phase_seed']) {
                $this->userService->create($data);
                return $this->jsonSuccess();
            }
            return $this->jsonError('Empty data');
        } catch (ContentEmptyException $e) {
            return $this->jsonError('Empty data');
        } catch (ServerException $e) {
            return $this->jsonError('Error create user: ' . $e->getMessage());
        }
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
