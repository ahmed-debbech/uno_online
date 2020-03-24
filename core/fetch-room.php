<?php
    session_start();
    include("../entities/player.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($player); 
    header("Location: ../view/game-play.php?player-id=".$playerId);
?>