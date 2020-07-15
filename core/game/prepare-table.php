<?php
    include_once("../../entities/game/shuffler.php");
    include_once("../../entities/game/stack.php");
    $shuf = new Shuffler();
    $stack = new Stack($_GET["room-code"] ,108, $_GET["room-code"],1);
    $shuf->createStack($stack);
    $shuf->shuffleCards($stack);
    $shuf->organizeCards($_GET["room-code"]);
    $shuf->setCardOnTable($_GET["room-code"]);
    header("Location: ../../game-play.php?player-name=".$_GET["player-name"]."&player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
?>