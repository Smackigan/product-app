<?php

class productController extends Controller 
{


    public function add() 
    {
        return $this->view('views/add_product.view');
    }
}