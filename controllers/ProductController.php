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
            $name = trim($_POST['name']);

            // Validate
            $validator = new Validator();
            $uniqueSkuError = $validator->validateUniqueSku($sku);
            $skuErrors = $validator->validateSku($sku);
            $nameErrors = $validator->validateName($name);
            
            header('Content-type: application/json');

            if (empty($uniqueSkuError) && (empty($skuErrors)) && (empty($nameErrors))) {
                // valid -> continue with inserting data
                $db = new DB();
                $sql = "INSERT INTO products (sku, name) VALUES (?, ?)";
                $stmt = $db->getConnection($sql);

                mysqli_stmt_bind_param($stmt, "ss", $sku, $name);
                mysqli_stmt_execute($stmt);

                // Close the prepared statement
                mysqli_stmt_close($stmt);

                $response = array('success' => true, 'message' => '');
                error_log(print_r($response, true));
                echo json_encode($response);
        } else {
            // there are validation errors
            $errors = array(
                'skuError' => (!empty($uniqueSkuError) || !empty($skuErrors)) ? ($uniqueSkuError['sku_unique'] ?? $skuErrors['sku_length'] ?? $skuErrors['sku_empty'] ?? '') : '',
                'nameError' => (!empty($nameErrors)) ? ($nameErrors['name_empty'] ?? $nameErrors['name_length'] ?? $nameErrors['name_string'] ?? '') : ''
            );
            $response = array('success' => false, 'errors' => $errors);
            error_log(print_r($response, true));
            echo json_encode($response);
        }
    }
}
}

$productController = new ProductController();
$productController->createNewProduct();
