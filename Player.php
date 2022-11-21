<?php
require_once "db/Database.php";
class Player
{




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



    public static function searchPlayerOnField($field, $players)
    {

        $player_array = array_filter($players, function ($player) use ($field) {
            return $player['field'] == $field;
        });

        return reset($player_array);
    }

    public static function deleteFieldPropFromPlayer($field, $players)
    {
        $player = self::searchPlayerOnField($field, $players);
        global $database;
        $sql = "UPDATE player SET field='' WHERE id='${player['id']}'";
        return mysqli_query($database->connection, $sql);
    }

    public static function addPlayerField($field, $id)
    {
        global $database;
        $sql = "UPDATE player SET field='${field}' WHERE id=${id}";
        return mysqli_query($database->connection, $sql);
    }
}
