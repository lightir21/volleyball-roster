<?php include 'includes/header.php' ?>
<?php include 'Player.php' ?>
<style>
    <?php include 'style.css' ?>
</style>


<?php require_once "db/Database.php" ?>
<form class="form-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
    <ul class="list-container">
        <h3>your roster</h3>
        <?php

        $player = new Player;
        $query = $player->getAllPlayers();


        while ($row = mysqli_fetch_assoc($query)) {
            echo "<li > ${row['jersey']} -  ${row['playername']}, position: ${row['position']}  </li>";
        }
        ?>
    </ul>


</div>



<div class="field">
    <a href="index.php?position=left-top" class="field-item  left-top">4</a>
    <a href="index.php?position=middle-top" class="field-item  middle-top">3</a>
    <a href="index.php?position=right-top" class="field-item  right-top">2</a>
    <a href="index.php?position=left-back" class="field-item  left-back">5</a>
    <a href="index.php?position=middle-back" class="field-item  middle-back">6</a>
    <a href="index.php?position=right-back" class="field-item right-back">1</a>
    <?php
    if (isset($_GET['position'])) {
        include("includes/players-roster.php");
    }

    ?>

</div>


<?php include_once 'includes/footer.php' ?>