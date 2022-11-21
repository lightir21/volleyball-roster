<?php include 'includes/header.php' ?>
<?php include 'Player.php' ?>
<style>
    <?php include 'style.css' ?>
</style>

<!-- <form action='index.php/delete-player=${row['id']}' method='POST'>
                    <input  type='hidden' value='${row['id']}' name='delete-player'></input>
                    <input class='delete-player' type='submit' value='Delete'></input>
                </form> -->


<?php require_once "db/Database.php" ?>

<form class="form-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="name" placeholder="player name">
    <input type="number" name="jersey" placeholder="player jersey number">
    <input type="text" name="position" placeholder="player position">
    <input type="submit" value="add player" name="submit"></input>
</form>
<div class="rosterList">
    <?php
    $players = array();
    $db = new Database;
    $db->connection;

    if (isset($_POST['submit'])) {
        print_r($_POST);
        ['name' => $name, 'jersey' => $jersey, 'position' => $position] = $_POST;

        Player::addPlayerToDB($name, $jersey, $position);
    }
    ?>
    <ul class="list-container">
        <h3>your roster</h3>
        <?php

        $player = new Player;
        $query = $player->getAllPlayers();


        while ($row = mysqli_fetch_assoc($query)) {
            $players[] = $row;
            echo "<li class='list-item'> ${row['jersey']} - ${row['playername']}, position: ${row['position']}
            <div class='buttons-container'>
                <a class='update-player' href='index.php?delete-player=${row['id']}'>Update</a>
              <a class='delete-player' href='index.php?delete-player=${row['id']}'>Delete</a>
            </div>
        </li>";
        }
        ?>
    </ul>

    <?php

    if (isset($_REQUEST['delete-player'])) {
        Player::deletePlayer($_REQUEST['delete-player']);
        echo 'Successfully deleted';
        header("Location: index.php");
    }

    ?>
</div>



<?php

print_r($_REQUEST);
if (isset($_REQUEST['position'], $_REQUEST['player-id'])) {
    $field = $_REQUEST['position'];
    $id = $_REQUEST['player-id'];
    Player::addPlayerField($field, $id);
};


echo "<div class='field'>
    <a href='index.php?position=left-top' class='field-item  left-top'> </a>
    <a href='index.php?position=middle-top' class='field-item  middle-top'>3</a>
    <a href='index.php?position=right-top' class='field-item  right-top'>2</a>
    <a href='index.php?position=left-back' class='field-item  left-back'>5</a>
    <a href='index.php?position=middle-back' class='field-item  middle-back'>6</a>
    <a href='index.php?position=right-back' class='field-item right-back'>1</a>"
?>

<?php
if (isset($_GET['position'])) {
    include("includes/players-roster.php");
}

?>

</div>


<?php include_once 'includes/footer.php' ?>