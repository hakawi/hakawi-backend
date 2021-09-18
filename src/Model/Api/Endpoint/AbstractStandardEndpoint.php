<?php

namespace App\Model\Api\Endpoint;

use App\Exception\Api\ResponseException;
use App\Model\Api\ApiResponseInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractStandardEndpoint extends AbstractEndpoint
{
    /**
     * @param \App\Model\Api\ApiResponseInterface $response
     *
     * @return bool
     */
    protected function isValidResponse(ApiResponseInterface $response): bool
    {
        return $response->isSuccess() && $response->isDataOk();
    }

    /**
     * @param array $queries
     * @param array $urlParams
     * @param array $options
     * @param bool $returnJsonData
     * @return ApiResponseInterface
     */
    public function get($queries = [], $urlParams = [], $options = [], $returnJsonData = true): ApiResponseInterface
    {
        $url      = $this->prepareUrl($urlParams);
        $response = $this->client->get($url, $queries, $options, $returnJsonData);

        if (!$this->isValidResponse($response)) {
            throw new ResponseException($response, $url, Request::METHOD_GET);
        }

        return $response;
    }

    /**
     * @param array $body
     * @param array $urlParams
     * @param array $options
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    public function post($body = [], $urlParams = [], $options = []): ApiResponseInterface
    {
        $url      = $this->prepareUrl($urlParams);
        $response = $this->client->post($url, $body, $options);

        if (!$this->isValidResponse($response)) {
            throw new ResponseException($response, $url, Request::METHOD_POST);
        }

        return $response;
    }

    /**
     * @param array $body
     * @param array $urlParams
     * @param array $options
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    public function patch($body = [], $urlParams = [], $options = []): ApiResponseInterface
    {
        $url      = $this->prepareUrl($urlParams);
        $response = $this->client->patch($url, $body, $options);

        if (!$this->isValidResponse($response)) {
            throw new ResponseException($response, $url, Request::METHOD_PATCH);
        }

        return $response;
    }
}
