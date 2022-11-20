<?php include_once 'includes/header.php' ?>
<?php include_once 'Player.php' ?>

<?php require_once "db/Database.php" ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="text" name="name" placeholder="player name">
    <input type="number" name="jersey" placeholder="player jersey number">
    <input type="text" name="position" placeholder="player position">
    <input type="submit" value="add player" name="submit"></input>
</form>
<div class="rosterList">
    <?php

    $db = new Database;
    $db->connection;

    if (isset($_POST['submit'])) {
        print_r($_POST);
        ['name' => $name, 'jersey' => $jersey, 'position' => $position] = $_POST;


        Player::addPlayerToDB($name, $jersey, $position);
    }
    ?>
    <?php

    $player = new Player;
    $query = $player->getAllPlayers();


    while ($row = mysqli_fetch_assoc($query)) {
        echo "${row['id']}";
    }
    ?>
</div>



<?php include_once 'includes/footer.php' ?>