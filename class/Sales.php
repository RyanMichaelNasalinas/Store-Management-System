<?php

class Sales extends Database
{
    public function getStockDetails($stock_id)
    {
        $conn = $this->dbConn();
        $stmt = $conn->prepare("SELECT * FROM product_items WHERE id = :id");
        $stmt->execute(['id' => $stock_id]);
        $stocks = $stmt->fetch();
        $row = $stmt->rowCount();

        return ($row > 0) ? $stocks : false;
    }

    public function insertSales($stocks_id, $qty, $price, $product_id, $customer_name)
    {
        $item = $this->getStockDetails($stocks_id);
        $vendor_name = $item['vendor_name'];
        // return $item;
        $conn = $this->dbConn();
        $stmt = $conn->prepare("INSERT into sales (`product_id`,`stocks_id`,`vendor_name`,`quantity`,`price`,`customer_name`) VALUES (:product_id,:stocks_id,:vendor_name,:quantity,:price,:customer_name)");
        $stmt->execute(['product_id' => $product_id, 'stocks_id' => $stocks_id, 'vendor_name' =>  $vendor_name, 'quantity' => $qty, 'price' => $price, 'customer_name' => $customer_name]);
    }
}
