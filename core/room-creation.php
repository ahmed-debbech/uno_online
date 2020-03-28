<?php
    session_start();
    include("../entities/room.php");
    include_once("../entities/player.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $roomCode = rand(1000,9999);
    $roomCode .= "r";
    $initialPlayer = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($initialPlayer); 
    $room = new Room($roomCode, $initialPlayer);
    $_GLOBALS[$roomCode] = $room;
    header("Location: ../view/create-room.php?room-code=".$room->getRoomCode()."&player-id=".$initialPlayer->getId());
?>  
