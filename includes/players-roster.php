<div class="pop-up-roster">
    <?php
    if (isset($_GET['close'])) {
        header("Location: index.php");
    }
    $player = new Player;
    $query = $player->getAllPlayers();


    ?>
    <a href="index.php?close=true">X</a>
    <ul class="list-container">
        <h3>choose player to assign to this position</h3>
        <?php echo "<a href='${_SERVER['REQUEST_URI']}&delete-position=true'>empty</a>" ?>


        <?php
        if (isset($_REQUEST['position'], $_REQUEST['delete-position'])) {
            Player::deleteFieldPropFromPlayer($_REQUEST['position'],  $players);
        }

        while ($row = mysqli_fetch_assoc($query)) {
            echo "<a href='${_SERVER['REQUEST_URI']}&player-id=${row['id']}' > ${row['jersey']} -  ${row['playername']}, position: ${row['position']}  </a>";
        }
        ?>
    </ul>
</div>