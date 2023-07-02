<?php

use Models\Product;

require_once('../database/DB.php');

// opertions with DB
class ProductsTable
{

    protected $conn;

    public function __construct()
    {
        $this->conn = new DB();
    }

    // Save product to DB
    public function insertProduct(Product $product)
    {
        $sku = $product->getSku();
        $name = $product->getName();
        $price = $product->getPrice();
        $value = $product->getValue();

        // Add product to table
        $db = $this->conn;
        $sql = "INSERT INTO products (sku, name, price, value) VALUES (?, ?, ?, ?)";
        $stmt = $db->getConnection($sql);

        mysqli_stmt_bind_param($stmt, "ssis", $sku, $name, $price, $value);
        mysqli_stmt_execute($stmt);

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    // public function addProduct(product){
    //     // add product to table
    // }

    // Chech for Unique SKU
    public function isSkuUnique($sku)
    {
        $db = new DB();
        $sql = 'SELECT COUNT(*) FROM products WHERE sku = ?';
        $stmt = $db->getConnection($sql);
        mysqli_stmt_bind_param($stmt, 's', $sku);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count === 0; // Return true if unique
    }

    // public function getProducts(){
    // read all from DB

    // create Product for each row

    // return array[Product]


}
