<?php

namespace Models;

abstract class Product
{
    private $sku;
    private $name;
    private $price;
    public $value;

    public function __construct($sku, $name, $price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->value = '';
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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function setData($data)
    {
        $this->setSku($data['sku']);
        $this->setName($data['name']);
        $this->setPrice($data['price']);
    }

}