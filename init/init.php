<?php
// Autoload Classes
spl_autoload_register(function ($className) {
    include_once './class/' . lcfirst($className) . '.php';
});

$database = new Database;
$user = new User;
$helper = new Helper;
$products = new Product;
$sales = new Sales;
