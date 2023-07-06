<?php

session_start();

require_once('../core/Controller.php');
require_once('../models/ProductsTable.php');

class DeleteProductsController extends Controller
{

    public function deleteAllProducts()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            error_log(print_r($data, true));

            // Check if the selectedIDs in the POST request
            if (isset($data['selectedIDs'])) {
                // Retrieve selectedIDs array from the request
                $selectedIDs = $data['selectedIDs'];

                // Create ProductsTable class and call delete method
                $productsTable = new ProductsTable();
                $productsTable->deleteProducts($selectedIDs);

                // Send success response
                $response = ['success' => true];
                echo json_encode($response);

            } else {
                // Send aerror response
                $response = ['success' => false, 'message' => 'Missing selectedIDs'];
                echo json_encode($response);
            }
        }
    }
}

$productController = new DeleteProductsController();
$productController->deleteAllProducts();
