<?php
    include("../entities/player.php");
    session_start();
    $playerId = rand(1000,9999);
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = $player; 
    header("Location: ../view/game-play.html");
?>