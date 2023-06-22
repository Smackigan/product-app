<?php

require_once '../config/config.php';

class DB
{
    protected $conn;

    public function __construct()
    {
        $this->conn = $this->connect();
    }

    public function connect()
    {

        $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            die('DB connection error: ' . mysqli_connect_error());
        }

        return $conn;
    }

    public function getConnection()
        {
            return $this->conn;
        }
}
