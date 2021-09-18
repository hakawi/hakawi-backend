<?php

namespace App\Model\Api;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiResponseInterface
 *
 * @package \App\Entity\Api
 */
abstract class AbstractApiResponse implements ApiResponseInterface
{
    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var bool
     */
    protected $dataOk = false;

    /**
     * AbstractApiResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param bool                                $returnJsonData
     */
    public function __construct(ResponseInterface $response, $returnJsonData = true)
    {
        $this->response = $response;
        $this->extractData($response, $returnJsonData);
    }

    /**
     * @param ResponseInterface $response
     *
     * @param bool              $returnJsonData
     *
     * @return mixed|void
     */
    public function extractData(ResponseInterface $response, $returnJsonData = true)
    {
        $this->body = $response->getBody()->getContents();
        if (!$returnJsonData) {
            $this->data = $this->body;
            $this->dataOk = true;
            return;
        }

        $data = json_decode($this->body, 1);
        if (json_last_error() == JSON_ERROR_NONE) {
            $this->data = $data ?? [];
            $this->dataOk = true;
        }
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return (string) $this->body;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->response->getStatusCode() >= 200 && $this->response->getStatusCode() < 300;
    }

    /**
     * @return bool
     */
    public function isDataOk()
    {
        return (bool) $this->dataOk;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRawResponse()
    {
        return $this->response;
    }

    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return is_array($this->data) && isset($this->data[$key]) ? $this->data[$key] : $default;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}
