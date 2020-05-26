<?php

class Product extends Database
{
    public function checkProductExists(string $product_name)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT LOWER('product_name') FROM products WHERE product_name = :product_name");
        $stmt->execute(['product_name' => $product_name]);
        $row = $stmt->rowCount();

        return ($row > 0) ? $stmt->fetch() : false;
    }

    public function addProduct(string $product_name, string $product_type, $min_stock)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("INSERT into products (`product_name`,`product_type`,`min_stock`) VALUES (:product_name,:product_type,:min_stock)");
        $stmt->execute(['product_name' => $product_name, 'product_type' => $product_type, 'min_stock' => $min_stock]);
    }

    public function fetchProducts()
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $products = $stmt->fetchAll();
        $row = $stmt->rowCount();

        return ($row > 0) ? $products : false;
    }

    public function fetchSingleProduct(int $id)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT tbl1.id, product_name, product_type, min_stock,SUM(quantity) as quantity_total FROM (SELECT * FROM products WHERE products.id = :id) tbl1 INNER JOIN product_items tbl2 ON tbl1.id = tbl2.product_id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        $row = $stmt->rowCount();

        return ($row > 0)  ? $product : false;
    }

    public function addProductStocks(int $product_id, int $quantity, $price, $vendor_name, $batch_number,  $added_by)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("INSERT into product_items(`product_id`,`quantity`,`price`,`vendor_name`,`batch_number`,`added_by`) VALUES (:product_id,:quantity,:price,:vendor_name,:batch_number,:added_by)");
        $stmt->execute(['product_id' => $product_id, 'quantity' => $quantity, 'price' => $price, 'vendor_name' => $vendor_name, 'batch_number' => $batch_number, 'added_by' => $added_by]);
    }

    public function fetchProductStocks($product_id)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT tbl1.id, tbl1.vendor_name, tbl1.price, tbl1.quantity, SUM(tbl2.quantity) as sales_qty, SUM(tbl2.quantity * tbl2.price) as sales_total FROM product_items tbl1 LEFT JOIN sales tbl2 ON tbl1.id = tbl2.stocks_id WHERE tbl1.product_id = :product_id GROUP BY tbl1.id");
        $stmt->execute(['product_id' => $product_id]);
        $product_stocks = $stmt->fetchAll();
        $row = $stmt->rowCount();

        return ($row > 0) ? $product_stocks : false;
    }
}
