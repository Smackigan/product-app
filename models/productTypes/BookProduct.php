<?php

namespace models\productTypes;

use Models\Product;

class BookProduct extends Product 
{
    private $weight;
    private $product;
    private $value;

    public function __construct($sku, $name, $price)
    {
        parent::__construct($sku, $name, $price);
        
        $this->weight = 0;
        $this->product = 'Book';
        $this->value = '';
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
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