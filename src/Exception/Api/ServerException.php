<?php

namespace App\Exception\Api;

use Throwable;

class ServerException extends \Exception implements ServerExceptionInterface
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'Server error', $code, $previous);
    }
}