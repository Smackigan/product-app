<?php

namespace Models;

abstract class Product
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $product;
    private $value;

    public function __construct()
    {
        $this->sku = '';
        $this->name = '';
        $this->price = '';
        $this->product = '';
        $this->value = '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    
    public function setPrice($price)
    {
        $this->price = $price;
    }

    
}