<div class="pop-up-roster">
    <?php
    if (isset($_GET['close'])) {
        header("Location: index.php");
    }
    ?>
    <a href="index.php?close=true">X</a>
    <ul class="list-container">
        <h3>choose player to assign to this position</h3>
        <?php

        $player = new Player;
        $query = $player->getAllPlayers();


        while ($row = mysqli_fetch_assoc($query)) {
            echo "<a href='${_SERVER['REQUEST_URI']}&player-id=${row['id']}' > ${row['jersey']} -  ${row['playername']}, position: ${row['position']}  </a>";
        }
        ?>
    </ul>
</div>