<?php

namespace App\Util;

use ReflectionClass;
use ReflectionException;

final class BrandType
{
    const APPLE = 'apple';
    const LENOVO = 'lenovo';
    const DELL = 'dell';

    private function __construct()
    {
    }

    /**
     * @return array
     *
     * @throws ReflectionException
     */
    public static function getAll() : array
    {
        $rClass = new ReflectionClass(__CLASS__);

        return $rClass->getConstants();
    }

    /**
     * @param string $brand
     * @return string
     * @throws ReflectionException
     */
    public static function getName(string $brand) : string
    {
        $all = self::getAll();
        $key = array_search($brand, $all);

        return (false !== $key ? ucwords($all[$key]) : 'Other');
    }

}