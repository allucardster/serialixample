<?php

namespace App\Util;

final class OffPrice
{
    private function __construct()
    {
    }

    /**
     * @param string $brand
     *
     * @return float
     */
    public static function getPercentOff(string $brand) : float
    {
        switch ($brand) {
            case BrandType::APPLE:
                return 0.1;
            case BrandType::LENOVO:
                return 0.15;
            case BrandType::DELL:
                return 0.2;
            default:
                return 0.0;
        }
    }

    /**
     * @param string $brand
     * @param float $price
     *
     * @return array
     */
    public static function getPrice(string $brand, float $price) : array
    {
        $off = self::getPercentOff($brand);
        $percentOff = intval(round( $off * 100 ));

        return [
            'current' => number_format($price * (1 - $off), 2),
            'standard' => number_format($price, 2),
            'percent_off' => $percentOff,
        ];
    }
}