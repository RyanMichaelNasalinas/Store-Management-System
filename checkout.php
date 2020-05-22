<?php
require_once 'init/init.php';

$total = count($_POST['stocks_id']);

for ($i = 0; $i < $total; $i++) {
    $product = $sales->insertSales(
        $_POST['stocks_id'][$i],
        $_POST['qty'][$i],
        $_POST['price'][$i],
        $_POST['product_id'],
        $_POST['customer_name']
    );
}

header("location: " . $_SERVER['HTTP_REFERER']);
