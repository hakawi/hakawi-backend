<?php

namespace App\Model\Api;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractApiClient
 *
 * @package App\Model\Api
 */
abstract class AbstractApiClient implements ApiClientInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param       $url
     * @param array $params
     * @param array $options
     * @param bool  $returnJsonData
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    public function post($url, $params = [], $options = [], $returnJsonData = true): ApiResponseInterface
    {
        if ($params) {
            $options = array_merge($options, ['body' => json_encode($params)]);
        }
        $rawResponse = $this->client->post($url, $options);

        return $this->prepareResponse($rawResponse, $returnJsonData);
    }

    /**
     * @param       $url
     * @param array $queries
     *
     * @param array $options
     * @param bool  $returnJsonData
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    public function get($url, $queries = [], $options = [], $returnJsonData = true): ApiResponseInterface
    {
        if ($queries) {
            $options = array_merge($options, ['query' => $queries]);
        }
        $rawResponse = $this->client->get($url, $options);

        return $this->prepareResponse($rawResponse, $returnJsonData);
    }

    /**
     * @param       $url
     * @param array $params
     * @param array $options
     * @param bool  $returnJsonData
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    public function patch($url, $params = [], $options = [], $returnJsonData = true): ApiResponseInterface
    {
        if ($params) {
            $options = array_merge($options, ['body' => json_encode($params)]);
        }
        $rawResponse = $this->client->patch($url, $options);

        return $this->prepareResponse($rawResponse, $returnJsonData);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $rawResponse
     * @param bool                                $returnJsonData
     *
     * @return \App\Model\Api\ApiResponseInterface
     */
    abstract protected function prepareResponse(ResponseInterface $rawResponse, $returnJsonData = true): ApiResponseInterface;
}
