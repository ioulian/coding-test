<?php

namespace Models\Discounts;

class Discount1 extends AbstractDiscount {

    /**
     * @var float
     */
    private static $discount = .1;

    /**
     * @var float
     */
    private static $discountFrom = 1000;

    /**
     * {@inheritdoc}
     */
    public static function getDiscount($order) {
        $rawPrice = $order->getRawPrice();

        return $rawPrice > self::$discountFrom ? $rawPrice * self::$discount : 0;
    }
}
