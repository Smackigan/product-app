<?php

class Controller
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new DB();
    }

}