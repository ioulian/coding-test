<?php

namespace Entity;

class ProductRepository
{
    public function __construct() { }

    public function getProductById($id) {
        $db = json_decode(file_get_contents(getcwd().'/../data/products.json'), true);

        $productArray = $db[array_search($id, array_column($db, 'id'))];

        $product = new Product();
        $product->setId($productArray['id']);
        $product->setUnitPrice((float)$productArray['price']);
        $product->setCategory((int)$productArray['category']);

        return $product;
    }
}
