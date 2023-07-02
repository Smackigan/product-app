<?php

namespace models\productTypes;

use Models\Product;

require_once('../models/Product.php');

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price);

        $this->size = '0';
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function calculateValue()
    {
        $calc =  "Size: " . strval($this->getSize()) . " MB";
        return $calc;
    }

    public function setData($data)
    {
        error_log('Received size: ' . $data['size']);
        parent::setData($data);
        if (isset($data['size'])) {
            $this->setSize($data['size']);
            $value = $this->calculateValue();
            $this->setValue($value);
        }
    }
}
