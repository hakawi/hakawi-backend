<?php

namespace App\Model\Api;

use Psr\Http\Message\ResponseInterface;

class ApiClient extends AbstractApiClient
{
    /**
     *
     * @param \Psr\Http\Message\ResponseInterface $rawResponse
     *
     * @param bool                                $returnJsonData
     *
     * @return ApiResponseInterface
     */
    protected function prepareResponse(ResponseInterface $rawResponse, $returnJsonData = true): ApiResponseInterface
    {
        return new ApiResponse($rawResponse, $returnJsonData);
    }
}
