<?php

namespace App\Model\Api\Endpoint;

use App\Model\Api\ApiClientInterface;
use App\Model\Api\ApiResponseInterface;

/**
 * Class AbstractEndpoint
 *
 * @package App\Model\Api\Endpoint
 */
abstract class AbstractEndpoint
{
    /**
     * @var \App\Model\Api\ApiClientInterface
     */
    protected $client;

    /**
     * AbstractEndpoint constructor.
     *
     * @param \App\Model\Api\ApiClientInterface $client
     */
    public function __construct(ApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $urlParams
     *
     * @return string
     */
    protected function prepareUrl($urlParams = []): string
    {
        return $this->makeEndpoint($this->getEndpoint(), $urlParams);
    }

    /**
     * @param \App\Model\Api\ApiResponseInterface $response
     *
     * @return bool
     */
    protected function isValidResponse(ApiResponseInterface $response): bool
    {
        return $response->isSuccess();
    }

    /**
     * @param       $endpoint
     * @param array $params
     *
     * @return string
     */
    protected function makeEndpoint($endpoint, $params = []): string
    {
        foreach ($params as $name => $value) {
            $endpoint = str_replace('{' . $name . '}', trim($value), $endpoint);
        }

        return $endpoint;
    }

    /**
     * @return string
     */
    abstract protected function getEndpoint(): string;
}
