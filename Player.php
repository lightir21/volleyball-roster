<?php
require_once "db/Database.php";
class Player
{

    public $players;



    public static function addPlayerToDB($name, $jersey, $position)
    {

        global $database;

        $the_object = new self;
        $sql = "INSERT INTO player (`playername`, `jersey`, `position`)
        VALUES ('" . $name . "', '" . $jersey . "', '" . $position . "')";

        if ($database->connection->query($sql) === TRUE) {
            $_POST = array();
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $the_object->connection->error;
        }
    }

    public function getAllPlayers()
    {
        global $database;

        $sql = 'SELECT * from player';

        return mysqli_query($database->connection, $sql);
    }

    public static function getOnePlayer($id)
    {
        global $database;
        $sql = "SELECT * FROM users WHERE id=${id} LIMIT 1";
        return mysqli_query($database->connection, $sql);
    }

    public static function deletePlayer($id)
    {
        $the_object = new self;
        global $database;
        $sql = "DELETE FROM player WHERE id='${id}'";
        mysqli_query($database->connection, $sql);
        $the_object->getAllPlayers();
    }
}
