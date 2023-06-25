<?php

namespace models\productTypes;

use Models\Product;

class DVDproduct extends Product
{
    private $size;
    private $product;
    private $value;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price);

        $this->size = '0';
        $this->product = 'DVD';
        $this->value = '';
    }

    public function getSize()
    {
        return $this->size;
    }
    
    public function setSize($size)
    {
        $this->size = $size;
    }

    public function getProduct()
    {
        return $this->product;
    }
    
    public function setProduct($product)
    {
        $this->product = $product;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
}