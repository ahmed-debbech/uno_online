<?php
    session_start();
    include("../entities/room.php");
    include_once("../entities/player.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $initialPlayer = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($initialPlayer); 
    $room = new Room($_GET["room-code"], $initialPlayer);
    $_GLOBALS[$_GET["room-code"]] = $room;
?>