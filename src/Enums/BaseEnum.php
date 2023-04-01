<?php

namespace Hyperzod\GophrSdkPhp\Enums;

class BaseEnum
{
    public function getConstants()
    {
        $reflectionClass = new \ReflectionClass($this);
        return $reflectionClass->getConstants();
    }
}
