<?php

session_start();

use Models\Product;

require_once('../models/Product.php');
require_once('../database/DB.php');
require_once('../models/Validator.php');

class ProductController extends Product
{

    public function createNewProduct() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
            $sku = trim($_POST['sku']);
            $name = trim($_POST['name']);
        
            // Validate
            $validator = new Validator();
            $skuErrors = $validator->validateSku($sku);
            $uniqueSkuError = $validator->validateUniqueSku($sku);
            $nameErrors = $validator->validateName($name);
        
            if (empty($skuErrors) && empty($uniqueSkuError) && empty($nameErrors)) {
        
            $db = new DB();
            $sql = "INSERT INTO products (sku, name) VALUES (?, ?)";
            $stmt = $db->getConnection($sql);
        
            mysqli_stmt_bind_param($stmt, "ss", $sku, $name);
            mysqli_stmt_execute($stmt);
        
            // Check if the data was inserted successfully
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                header('Location: ../views/home.view.php');
                exit();
            } else {
                echo "Error inserting data";
            }
        
            // Close the prepared statement
            mysqli_stmt_close($stmt);
        
            } else {  
                    
                header("Location: ../views/add_product.view.php");

                $_SESSION['skuErrors'] = $skuErrors;
                $_SESSION['uniqueSkuError'] = $uniqueSkuError;
                $_SESSION['nameErrors'] = $nameErrors;

                exit();
        
            }
        
        }
    }

}

$productController = new ProductController();
$productController->createNewProduct();



