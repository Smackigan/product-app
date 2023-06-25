<?php

namespace models\productTypes;

use Models\Product;

class FurnitureProduct extends Product 
{
    private $height;
    private $width;
    private $length;
    private $product;
    private $value;

    public function __construct()
    {
        $this->height = 0;
        $this->width = 0;
        $this->length = 0;
        $this->product = 'Furniture';
        $this->value = '';
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    protected function calculatedValue()
    {
        $value = $this->getWidth() . $this->getHeight() . $this->getLength();
        return $value;
    }
}