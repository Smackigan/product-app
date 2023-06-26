<?php

require_once('../database/DB.php');

class Validator
{
    public $uniqueSkuError;
    public $skuErrors;
    public $nameErrors;

    public function validateUniqueSku($sku)
    {
        $uniqueSkuError = [];

        $db = new DB();
        $sql = 'SELECT COUNT(*) FROM products WHERE sku = ?';
        $stmt = $db->getConnection($sql);
        mysqli_stmt_bind_param($stmt, 's', $sku);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    
        if ($count > 0) {
            $uniqueSkuError['sku_unique'] = 'SKU must be unique';
        }
        
        return $uniqueSkuError; 
    }
    
    public function validateSku($sku)
    {
        $skuErrors = [];

        if (empty($sku)) {
            $skuErrors['sku_empty'] = 'Please, provide the SKU!!!';
        } elseif (strlen($sku) > 10) {
            $skuErrors['sku_length'] = 'SKU must be less than 10 characters long';
        }

        return $skuErrors;
    }

    public function validateName($name)
    {
        $nameErrors = [];

        if (empty($name)) {
            $nameErrors['name_empty'] = 'Please, provide the name';
        } elseif (strlen($name) > 10) {
            $nameErrors['name_length'] = 'Product name is too long';
        } elseif (!is_string($name)) {
            $nameErrors['name_string'] = 'Please, provide the data of indicated type';
        }
        return $nameErrors;
    }

}
