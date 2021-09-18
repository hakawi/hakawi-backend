<?php

namespace App\Model\Api\Mapper;

use App\Model\Api\Entity\ApiBaseEntity;

/**
 * Interface ApiMapperInterface
 *
 * @package App\Model\Api\Mapper
 */
interface ApiMapperInterface
{
    /**
     * @param $data
     *
     * @return null|ApiBaseEntity
     */
    public function convertToEntity($data);

    /**
     * @param ApiBaseEntity $entity
     * @param $data
     */
    public function addDataToEntity(ApiBaseEntity $entity, $data);

    /**
     * @param ApiBaseEntity $entity
     *
     * @return array
     */
    public function convertEntityToArray(ApiBaseEntity $entity);

}
