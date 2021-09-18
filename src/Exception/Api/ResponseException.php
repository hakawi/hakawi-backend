<?php

namespace App\Exception\Api;

use App\Model\Api\ApiResponseInterface;

class ResponseException extends \RuntimeException
{
    protected $response;

    public function __construct(ApiResponseInterface $response, $url, $method)
    {
        $messageFormatted = sprintf(
            "response failed: \n
                   url: `%s` \n
                   method: `%s` \n
                   status code `%s \n
                   body: `%s` \n",
            $url,
            $method,
            $response->getStatusCode(),
            $response->getBody()
        );

        parent::__construct($messageFormatted);

        $this->response = $response;
    }

    public function getReponse()
    {
        return $this->response;
    }
}