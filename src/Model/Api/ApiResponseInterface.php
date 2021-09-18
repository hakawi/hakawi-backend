<?php

namespace App\Model\Api;

/**
 * Class ApiResponseInterface
 *
 * @package \App\Entity\Api
 */
interface ApiResponseInterface
{
    /**
     * @return string
     */
    public function getBody();
    
    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return mixed
     */
    public function isDataOk();

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRawResponse();

    /**
     * @param      $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @return mixed
     */
    public function getData();

    /**
     * @return int
     */
    public function getStatusCode();
}
