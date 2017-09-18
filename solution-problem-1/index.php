<?php

// This will be autoloaded in the real world
include 'Entity/Order.php';
include 'Entity/Product.php';
include 'Entity/ProductRepository.php';
include 'Models/Discounts/AbstractDiscount.php';
include 'Models/Discounts/Discount1.php';
include 'Models/Discounts/Discount2.php';
include 'Models/Discounts/Discount3.php';
include 'Models/Discounts/Manager.php';

$orderToLoad = isset($_GET['order']) && in_array($_GET['order'], ['1', '2', '3']) ? $_GET['order'] : '1';

$order = new \Entity\Order(file_get_contents(getcwd().'/../example-orders/order'.$orderToLoad.'.json'));

header('Content-type:application/json');
echo json_encode($order);
exit;
