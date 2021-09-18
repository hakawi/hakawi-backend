<?php


namespace App\Entity;


trait ObjectToArrTrait
{
    public function toArray(): array
    {
        $retArr = [];
        foreach($this as $key => $value) {
            $retArr[$key] = $value;
        }
        return $retArr;
    }
}