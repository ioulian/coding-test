<?php

namespace Models\Discounts;

class Discount3 extends AbstractDiscount
{

    /**
     * @var float
     */
    private static $discount = .2;

    /**
     * {@inheritdoc}
     */
    public static function getDiscount($order)
    {
        $products = $order->getItems();
        $productsInTools = [];
        $cheapestProduct = NULL;

        foreach ($products as $product) {
            if ($product->getCategory() === 1) {
                $productsInTools[] = $product;

                if ($cheapestProduct === NULL) {
                    $cheapestProduct = $product;
                } else {
                    if ($product->getUnitPrice() < $cheapestProduct->getUnitPrice()) {
                        $cheapestProduct = $product;
                    }
                }
            }
        }

        return count($productsInTools) >= 2 ? $cheapestProduct->getUnitPrice() * self::$discount : 0;
    }
}
