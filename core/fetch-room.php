<?php
    session_start();
    include_once("../entities/room.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($player); 
    $file = fopen($_GET["room-code"].".txt", "r");
    if($file != FALSE){
        header("Location: ../view/game-play.php?player-id=".$playerId);
    }else{
        echo "room not found 404";
    }
?>