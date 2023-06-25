<?php

require_once('../database/DB.php');

class Validator
{
    public $uniqueSkuError;
    public $skuErrors;
    public $nameErrors;

    public function validateUniqueSku($sku)
    {
        $db = new DB();
        $sql = 'SELECT COUNT(*) FROM products WHERE sku = ?';
        $stmt = $db->getConnection($sql);
        mysqli_stmt_bind_param($stmt, 's', $sku);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    
        if ($count > 0) {
            return 'SKU has already been used';
        }
        
        return ''; 
    }
    
    public function validateSku($sku)
    {
        $skuErrors = [];

        if (empty($sku)) {
            $skuErrors[] = 'Please, provide the SKU';
        } elseif (strlen($sku) > 30) {
            $skuErrors[] = 'SKU must be less than 30 characters long';
        }

        return $skuErrors;
    }

    public function validateName($name)
    {
        $nameErrors = [];

        if (empty($name)) {
            $nameErrors[] = 'Please, provide the name';
        } elseif (strlen($name) > 10) {
            $nameErrors[] = 'Product name is too long';
        } elseif (!is_string($name)) {
            $nameErrors[] = 'Please, provide the data of indicated type';
        }
        return $nameErrors;
    }

}
