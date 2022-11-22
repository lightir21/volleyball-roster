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
<div class="content-container">
    <div class="left">


        <form class="form-container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input class="input" type="text" name="name" placeholder="Player Name">
            <input class="input" type="number" name="jersey" placeholder="Player Jersey Number">
            <input class="input" type="text" name="position" placeholder="Player Position">
            <input class="input-button" type="submit" value="Add Player" name="submit"></input>
        </form>

        <div class="rosterList">
            <?php
            $players = array();
            $db = new Database;
            $db->connection;

            if (isset($_POST['submit'])) {
                ['name' => $name, 'jersey' => $jersey, 'position' => $position] = $_POST;

                Player::addPlayerToDB($name, $jersey, $position);
            }
            ?>
            <ul class="list-container">
                <h3>Your Roster</h3>
                <?php

                $player = new Player;
                $query = $player->getAllPlayers();


                while ($row = mysqli_fetch_assoc($query)) {
                    $players[] = $row;
                    echo "<li class='list-item'> ${row['jersey']} - ${row['playername']}, position: ${row['position']}
            <div class='buttons-container'>
               
              <a class='delete-player' href='index.php?delete-player=${row['id']}'>Delete</a>
            </div>
        </li>";
                }
                ?>
            </ul>

            <?php

            if (isset($_REQUEST['delete-player'])) {
                Player::deletePlayer($_REQUEST['delete-player']);
            }

            ?>
        </div>

    </div>
    <div class="right">


        <?php


        $left_top = Player::searchPlayerOnField('left-top', $players);
        $middle_top = Player::searchPlayerOnField('middle-top', $players);
        $right_top = Player::searchPlayerOnField('right-top', $players);
        $left_back = Player::searchPlayerOnField('left-back', $players);
        $middle_back = Player::searchPlayerOnField('middle-back', $players);
        $right_back = Player::searchPlayerOnField('right-back', $players);


        // print_r($_REQUEST);
        if (isset($_REQUEST['position'], $_REQUEST['player-id'])) {
            $field = $_REQUEST['position'];
            $id = $_REQUEST['player-id'];
            Player::addPlayerField($field, $id);
        };




        echo "<div class='field'>
        <a href='index.php?position=right-top' class='field-item  right-top'>" . ($right_top ? $right_top['playername'] : '2') . "</a>
        <a href='index.php?position=right-back' class='field-item right-back'>" . ($right_back ? $right_back['playername'] : '1') . "</a>
        <a href='index.php?position=middle-top' class='field-item  middle-top'>" . ($middle_top ? $middle_top['playername'] : '3') . "</a>
        <a href='index.php?position=middle-back' class='field-item  middle-back'>" . ($middle_back ? $middle_back['playername'] : '6') . "</a>
        <a href='index.php?position=left-top' class='field-item  left-top'>" . ($left_top ? $left_top['playername'] : '4') . " </a>
        <a href='index.php?position=left-back' class='field-item  left-back'>" . ($left_back ? $left_back['playername'] : '5') . "</a>
        "
        ?>

        <?php
        if (isset($_GET['position'])) {
            include("includes/players-roster.php");
        }

        ?>

    </div>


    <?php include_once 'includes/footer.php' ?>
</div>
</div>