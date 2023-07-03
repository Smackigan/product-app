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

            $allErrors = [];
            // Validate
            $validator = new Validator();
            $allErrors = array_merge($allErrors, $validator->validateUniqueSku($sku));
            $allErrors = array_merge($allErrors, $validator->validateSku($sku));
            $allErrors = array_merge($allErrors, $validator->validateName($name));
            $allErrors = array_merge($allErrors, $validator->validatePrice($price));

            $productTypeValidator = new ProductTypeValidator();

            // Validation and errors based on the selected product type
            switch ($productType) {
                case 'DVD':
                    $size = $_POST['size'];
                    $allErrors = array_merge($allErrors, $productTypeValidator->validateSize($size));
                    $errors['dvdError'] = $sizeErrors['size'] ?? '';
                    break;
                case 'book':
                    $weight = $_POST['weight'];
                    $allErrors = array_merge($allErrors, $productTypeValidator->validateWeight($weight));
                    $errors['bookError'] = $weightErrors['weight'] ?? '';
                    break;
                case 'furniture':
                    $height = $_POST['height'];
                    $width = $_POST['width'];
                    $length = $_POST['length'];
                    $allErrors = array_merge($allErrors, $productTypeValidator->validateDimensions($height, $width, $length));
                    $errors['heightError'] = $dimensionErrors['height'] ?? '';
                    $errors['widthError'] = $dimensionErrors['width'] ?? '';
                    $errors['lengthError'] = $dimensionErrors['length'] ?? '';
                    break;
                default:
                    // Invalid product type
                    $errors['productTypeError'] = 'Invalid product type'; // CHECK!
                    break;
            }

            // print_r($allErrors);
            header('Content-type: application/json');

            if (empty($allErrors)) {

                if ($productType === 'DVD') {
                    $product = new DVD($sku, $name, $price);
                } elseif ($productType === 'book') {
                    $product = new Book($sku, $name, $price);
                } elseif ($productType === 'furniture') {
                    $product = new Furniture($sku, $name, $price);
                }

                if ($product) {
                    $product->setData($data);
                }

                // Insert data to the DB
                $productsTable = new ProductsTable();
                $productsTable->insertProduct($product);

                // prepare success response
                $response = array('success' => true, 'message' => '');
                error_log(print_r($response, true));
                error_log(json_encode($response));

                echo json_encode($response);

            } else {

                $response = array('success' => false, 'errors' => $allErrors);
                // error_log(print_r($response, true));
                // error_log(json_encode($response));

                echo json_encode($response);
            }
        }
    }
}

$productController = new ProductController();
$productController->createNewProduct();
