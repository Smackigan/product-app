<?php

use models\productTypes\DVD;
use models\productTypes\Book;
use models\productTypes\Furniture;

session_start();

// require_once('../database/DB.php');
require_once('../core/Controller.php');
require_once('../models/Validator.php');
require_once('../models/ProductsTable.php');
require_once('../models/productTypes/DVD.php');
require_once('../models/productTypes/Book.php');
require_once('../models/productTypes/Furniture.php');

class ProductController extends Controller
{

    public function createNewProduct()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $sku = trim($_POST['sku']);
            $name = trim($_POST['name']);
            $price = trim($_POST['price']);
            $productType = $_POST['productType'];
            $data = $_POST;

            // Validate
            $validator = new Validator();
            $uniqueSkuError = $validator->validateUniqueSku($sku);
            $skuErrors = $validator->validateSku($sku);
            $nameErrors = $validator->validateName($name);
            $priceErrors = $validator->validatePrice($price);

            header('Content-type: application/json');

            if (empty($uniqueSkuError) && (empty($skuErrors)) && (empty($nameErrors)) && (empty($priceErrors)) && (empty($productErrors))) {
                
                if ($productType === 'DVD') {
                    $product = new DVD($sku, $name, $price);
                    $product->setData($data);
                } elseif ($productType === 'book') {
                    $product = new Book($sku, $name, $price);
                    $product->setData($data);
                } elseif ($productType === 'furniture') {
                    $product = new Furniture($sku, $name, $price);
                    $product->setData($data);
                }
                
                // Insert data to the DB
                $productsTable = new ProductsTable();
                $productsTable->insertProduct($product);

                $response = array('success' => true, 'message' => '');
                error_log(print_r($response, true));
                echo json_encode($response);
            
            
            
            
            
            } else {
                // there are validation errors
                $errors = array(
                    'skuError' => (!empty($uniqueSkuError) || !empty($skuErrors)) ? ($uniqueSkuError['sku_unique'] ??
                        $skuErrors['sku_length'] ??
                        $skuErrors['sku_empty'] ??
                        '') : '',
                    'nameError' => (!empty($nameErrors)) ? ($nameErrors['name_empty'] ??
                        $nameErrors['name_length'] ??
                        $nameErrors['name_string'] ??
                        '') : '',
                    'priceError' => (!empty($priceErrors)) ? ($priceErrors['price_empty'] ??
                        $priceErrors['price_invalid'] ??
                        $priceErrors['price_negative'] ??
                        $priceErrors['price_length'] ??
                        '') : ''
                );

                $productTypeValidator = new ProductTypeValidator();

                // Errors based on the selected product type
                switch ($productType) {
                    case 'DVD':
                        $size = $_POST['size'];
                        $dvdErrors = $productTypeValidator->validateSize($size);
                        $errors['dvdError'] = (!empty($dvdErrors)) ? ($dvdErrors['size_empty'] ??
                            $dvdErrors['size_length'] ??
                            $dvdErrors['size_negative'] ??
                            $dvdErrors['size_invalid'] ??
                            '') : '';
                        break;
                    case 'book':
                        $weight = $_POST['weight'];
                        $bookErrors = $productTypeValidator->validateWeight($weight);
                        $errors['bookError'] = (!empty($bookErrors)) ? ($bookErrors['weight_empty'] ??
                            $bookErrors['weight_length'] ??
                            $bookErrors['weight_negative'] ??
                            $bookErrors['weight_invalid'] ??
                            '') : '';
                        break;
                    case 'furniture':
                        $height = $_POST['height'];
                        $width = $_POST['width'];
                        $length = $_POST['length'];
                        $dimensionErrors = $productTypeValidator->validateDimensions($height, $width, $length);
                        $errors['heightError'] = $dimensionErrors['height'] ?? '';
                        $errors['widthError'] = $dimensionErrors['width'] ?? '';
                        $errors['lengthError'] = $dimensionErrors['length'] ?? '';

                        break;
                    default:
                        // Invalid product type
                        $errors['productTypeError'] = 'Invalid product type';
                        break;
                }

                $response = array('success' => false, 'errors' => $errors);
                error_log(print_r($response, true));
                echo json_encode($response);
            }
        }
    }
}

$productController = new ProductController();
$productController->createNewProduct();
