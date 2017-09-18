<?php

namespace Models\Discounts;

class Manager
{
    private function __construct()
    {
    }

    /**
     * @param \Entity\Order $order
     *
     * @return float
     */
    public static function getTotalDiscount($order)
    {
        return array_reduce(
            self::getDiscounts(),
            function ($carry, $discount) use ($order) {
                /* @var $discount \Models\Discounts\AbstractDiscount */
                return $carry + call_user_func([$discount, 'getDiscount'], $order);
            },
            0
        );
    }

    private static function getDiscounts()
    {
        return [
            Discount1::class,
            Discount2::class,
            Discount3::class,
        ];
    }
}
