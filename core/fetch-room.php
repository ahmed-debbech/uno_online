<?php
    session_start();
    include_once("../entities/room.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId,"-1r");
    $file = fopen("../avail-rooms/".$_GET["room-code"].".txt", "r");
    if($file != FALSE){
        $player->setAssignedRoom($_GET["room-code"]);
        $_SESSION[$playerId] = serialize($player); 
        header("Location: ../view/game-play.php?player-id=".$playerId."&room-code=".$_GET["room-code"]);
    }else{
        echo "room not found 404";
    }
?>