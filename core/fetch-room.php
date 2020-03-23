<?php
    session_start();
    include("../entities/player.php");
    $playerId = rand(1000,9999);
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = $player; 
    header("Location: ../view/game-play.php");
?>