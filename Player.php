<?php
require_once "db/Database.php";
class Player
{

    public $players;

    // public static function setPlayerAttr($name, $jersey, $position)
    // {
    //     $the_object = new self;

    //     $the_object->playername = $name;
    //     $the_object->jersey = $jersey;
    //     $the_object->position = $position;
    // }

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
}
