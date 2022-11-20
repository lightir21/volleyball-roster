<?php
require_once "Player.php";
require_once "db-config.php";

class Database
{

    public $connection;

    function __construct()
    {
        $this->connect_db();
    }


    public function connect_db()
    {
        $this->connection = new mysqli(DB__HOST, DB__USER, DB__PASS, DB__NAME);


        if ($this->connection->connect_errno) {
            die("database connection failed badly" . $this->connection->connect_error);
        }
    }
}
$database = new Database();
