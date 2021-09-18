<?php

namespace App\Model\Api\Entity;

abstract class ApiBaseEntity
{
    /**
     * ApiBaseEntity constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if ($attributes) {
            $this->setFromArray($attributes);
        }
    }

    /**
     * @return array
     */
    abstract protected function getExcludedFromToArray();

    /**
     * @param $input
     * @return string
     */
    protected function convertToSnakeCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    /**
     * @param $string
     * @param bool $capitalizeFirstCharacter
     * @return mixed|string
     */
    protected function convertToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * @param $attribute
     * @return bool
     */
    public function has($attribute)
    {
        return property_exists($this, $this->convertToCamelCase($attribute));
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function get($attribute)
    {
        $getter = 'get' . $this->convertToCamelCase($attribute, true);
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
        $property = $this->convertToCamelCase($attribute);
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        return null;
    }

    /**
     * @param $attribute
     * @param $value
     * @return $this
     */
    public function set($attribute, $value)
    {
        $setter = 'set' . $this->convertToCamelCase($attribute, true);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }

        return $this;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setFromArray($data = [])
    {
        foreach ($data as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $except = $this->getExcludedFromToArray();
        $array = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (!in_array($key, $except)) {
                $value = $this->get($key);
                if ($value instanceof ApiBaseEntity) {
                    $value = $value->toArray();
                }
                $array[$this->convertToSnakeCase($key)] = $value;
            }
        }

        return $array;
    }
}
