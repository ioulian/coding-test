<?php

namespace Models\Discounts;

class Discount2 extends AbstractDiscount {

    /**
     * @var int
     */
    private static $addExtraEach = 5;

    /**
     * {@inheritdoc}
     */
    public static function getDiscount($order) {
        $products = $order->getItems();
        $totalDiscount = 0;

        foreach ($products as $product) {
            if ($product->getCategory() !== 2) {
                continue;
            }

            $freeProducts = floor($product->getQuantity() / self::$addExtraEach);

            if ($freeProducts > 0) {
                $product->setQuantity($product->getQuantity() + $freeProducts);
                $totalDiscount += $product->getUnitPrice() * $freeProducts;
            }
        }

        return $totalDiscount;
    }
}
