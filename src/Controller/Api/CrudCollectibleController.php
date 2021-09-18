<?php

namespace App\Controller\Api;

use App\Exception\Api\ContentEmptyException;
use App\Exception\Api\ServerException;
use App\Service\Collectible\CollectibleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CrudCollectibleController extends AbstractApiController
{
    private $collectibleService;

    public function __construct(
        CollectibleService $collectibleService
    ) {
        $this->collectibleService = $collectibleService;

    }

    /**
     * @Route("/api/collectible/user/{uid}", name="api_collectible_user_read", methods={"GET"})
     */

    public function getCollectible($uid): JsonResponse
    {
        dump($this->collectibleService->getByUser($uid));
        return $this->jsonSuccess();
    }


    /**
     * @Route("/api/collectible/create", name="api_collectible_create", methods={"POST"})
     */
    public function createCollectible(Request $request): JsonResponse
    {
        try {
            $data = $this->getJsonData($request);
            if ($data['url']) {
                $this->collectibleService->create($data);

                return $this->jsonSuccess();
            }

            return $this->jsonError('Empty data');
        } catch (ContentEmptyException $e) {
            return $this->jsonError('Empty data');
        } catch (ServerException $e) {
            return $this->jsonError('Error create user: ' . $e->getMessage());
        }
    }


}

