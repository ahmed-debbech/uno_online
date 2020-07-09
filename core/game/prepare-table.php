<?php
    include_once("../../entities/game/shuffler.php");
    $shuf = new Shuffler();
    $shuf->shuffleCards();
    header("Location: ../../game-play.php?player-name=".$_GET["player-name"]."&player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
?>