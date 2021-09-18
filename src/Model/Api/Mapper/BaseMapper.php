<?php

namespace App\Model\Api\Mapper;

use App\Model\Api\Entity\ApiBaseEntity;

abstract class BaseMapper implements ApiMapperInterface
{
    /**
     * @return mixed
     */
    abstract protected function getMapFields();

    /**
     * @return ApiBaseEntity
     */
    abstract protected function createApiEntity();

    /**
     * @param $data
     *
     * @return null|ApiBaseEntity
     */
    public function convertToEntity($data)
    {
        if (empty($data)) {
            return null;
        }

        $entity = $this->createApiEntity();
        $this->addDataToEntity($entity, $data);

        return $entity;
    }

    /**
     * @param ApiBaseEntity $entity
     * @param                                     $data
     */
    public function addDataToEntity(ApiBaseEntity $entity, $data)
    {
        foreach ($this->getMapFields() as $field => $key) {
            if (isset($data[$key])) {
                $entity->set($field, $data[$key]);
            }
        }
    }

    /**
     * @param ApiBaseEntity $entity
     *
     * @return array
     */
    public function convertEntityToArray(ApiBaseEntity $entity)
    {
        $data = [];
        foreach ($this->getMapFields() as $field => $key) {
            if ($entity->has($field)) {
                $data[$key] = $entity->get($field);
            }
        }

        return $data;
    }

}
