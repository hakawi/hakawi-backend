<?php

namespace App\Controller\Api;

use App\Exception\Api\ContentEmptyException;
use App\Exception\Api\ServerException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractApiController extends AbstractController
{
    protected function jsonSuccess($data = [], $statusCode = 200, $headers = [], $context = [])
    {
        return $this->json(
            ['data' => $data, 'success' => 1],
            $statusCode,
            $headers,
            $context
        );
    }

    protected function jsonError($message, $statusCode = 400, $headers = [], $context = [])
    {
        return $this->json(
            ['errors' => $message, 'success' => 0],
            $statusCode,
            $headers,
            $context
        );
    }

    protected function jsonServerError($message, $statusCode = 500, $headers = [], $context = [])
    {
        return $this->jsonError($message, $statusCode, $headers, $context);
    }

    /**
     * @param $tokenId
     * @param $tokenValue
     *
     * @throws \Exception
     */
    protected function checkCsrfToken($tokenId, $tokenValue): void
    {
        if (!$this->isCsrfTokenValid($tokenId, $tokenValue)) {
            throw new \Exception("CSRF token is invalid");
        }
    }

    /**
     * @param $dataJsonEncoded
     *
     * @return array
     *
     * @throws \App\Exception\Api\ServerException
     */
    protected function decodeJson($dataJsonEncoded)
    {
        if (!$this->container->has('serializer')) {
            throw new ServerException("Serializer has not been existed");
        }

        return $this->container
                ->get('serializer')
                ->decode($dataJsonEncoded, 'json');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     * @throws \App\Exception\Api\ContentEmptyException
     * @throws \App\Exception\Api\ServerException
     */
    protected function getJsonData(Request $request) {
        $body = $request->getContent();
        if (empty($body)) {
            throw new ContentEmptyException("Body is empty");
        }

        $data = $this->decodeJson($body);
        if (empty($data)) {
            throw new ContentEmptyException("Body is empty");
        }

        return $data;
    }
}
