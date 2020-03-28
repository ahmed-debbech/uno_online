<?php
    session_start();
    include_once("../entities/room.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($player); 
    $found = false;
    foreach($_GLOBALS as $room){
        if($room->getRoomCode() == $_GET["room-code"]){
            $found = true;
            $theroom = $room;
        }
    }
    if($found == true){
        header("Location: ../view/game-play.php?player-id=".$playerId);
    }else{
        echo "there's no such room";
    }
?>