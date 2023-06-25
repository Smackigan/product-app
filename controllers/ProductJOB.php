<?php
require_once('../database/DB.php');
require_once('../models/Validator.php');

class ProductController extends Controller 
{

    public function __construct()
    {
        parent::__construct();
    }

    // public function index()
    // {
    //     $data = $this->conn->getAllProducts();
    //     return $this->view('index');
    // }



    // public function validateProduct()
    // {
    //     $submittedSku = $_POST['sku'];

    //     $validation = new Validation();

    //     $validatedSku = $validation->validationSku($submittedSku);

    //     // check for errors?
    //     if ($validation->hasErrors()) {
    //         $errors = $validation->getErrors();
    //         exit();
    //     }
    // }
    
    public function createProduct()
    {
        $sql = 'INSERT INTO products (sku, name, price, product, value) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->conn->getConnection($sql);

        $stmt->prepare($sql) {

            $stmt->bind_param('s', $validSku);
            $validSku = $this->Sku;

            if (!$stmt->execute()) {
                die('Failed to execute stmt: ' . $stmt->error);
            }

            $stmt->close();

            header('Location: ../views/home.view.php');
            exit();
        }
    }

}