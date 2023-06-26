<?php

session_start();

use Models\Product;

require_once('../models/Product.php');
require_once('../database/DB.php');
require_once('../models/Validator.php');

class ProductController extends Product
{

    public function createNewProduct()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sku = trim($_POST['sku']);

            // Validate
            $validator = new Validator();
            $uniqueSkuError = $validator->validateUniqueSku($sku);
            $skuErrors = $validator->validateSku($sku);
            
            header('Content-type: application/json');

            if (empty($uniqueSkuError) && (empty($skuErrors)) ) {
                // valid -> continue with inserting data
                $db = new DB();
                $sql = "INSERT INTO products (sku) VALUES (?)";
                $stmt = $db->getConnection($sql);

                mysqli_stmt_bind_param($stmt, "s", $sku);
                mysqli_stmt_execute($stmt);

                // Close the prepared statement
                mysqli_stmt_close($stmt);

                $response = array('success' => true, 'message' => '');
                error_log(print_r($response, true));
                echo json_encode($response);
        } else {
            // there are validation errors
            $errors = array_merge($uniqueSkuError, $skuErrors);
            // $errorMessage = $errors[0]; 
            $skuErrorMessage = '';
            $nameErrorMessage = '';

            if (!empty($uniqueSkuError)) {
                $skuErrorMessage = $uniqueSkuError['sku_unique'];
            } elseif (!empty($skuErrors)) {
                $skuErrorMessage = $skuErrors['sku_empty'] ?? $skuErrors['sku_length'];
            } 

            
            $response = array('success' => false, 'message' => $skuErrorMessage);
            error_log(print_r($response, true));
            echo json_encode($response);
        }
    }
}
}

$productController = new ProductController();
$productController->createNewProduct();
