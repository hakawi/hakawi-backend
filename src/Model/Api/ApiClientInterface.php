<?php

namespace App\Model\Api;

interface ApiClientInterface
{
    public function post($uri, $params = [], $options = [], $returnJsonData = true): ApiResponseInterface;

    public function get($uri, $queries = [], $options = [], $returnJsonData = true): ApiResponseInterface;

    public function patch($uri, $queries = [], $options = [], $returnJsonData = true): ApiResponseInterface;
}
