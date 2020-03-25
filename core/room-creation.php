<?php
    session_start();
    include("../entities/room.php");
    include("../entities/player.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId);
    $_SESSION[$playerId] = serialize($player); 
    $room = new Room($_GET["room-code"], $initialPlayer);
    array_push($_GLOBALS, $room);
?>