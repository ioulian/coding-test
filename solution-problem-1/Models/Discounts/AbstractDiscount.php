<?php

namespace Models\Discounts;

class AbstractDiscount {

    private function __construct() {

    }

    /**
     * @param \Entity\Order $order
     * @return int Total discount on the order
     */
    public static function getDiscount($order) {
        return 0;
    }
}
