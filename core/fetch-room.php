<?php
    session_start();
    include_once("../entities/room.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId,"-1r");
    $file = fopen("../avail-rooms/".$_GET["roomnum"].".txt", "r");
    if($file != FALSE){
        $player->setAssignedRoom($_GET["roomnum"]);
        $_SESSION[$playerId] = serialize($player); 
        header("Location: ../view/queue-page.php?player-id=".$playerId."&room-code=".$_GET["roomnum"]);
    }else{
        echo "room not found 404";
    }
?>