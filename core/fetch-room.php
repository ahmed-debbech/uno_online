<?php
    session_start();
    include_once("../entities/room.php");
    $playerId = rand(1000,9999);
    $playerId .= "p";
    $player = new Player($_GET["player-name"],$playerId,"-1r");
    $file = fopen("../avail-rooms/".$_GET["roomnum"].".txt", "r");
    if($file != FALSE){
        $room = fread($file, filesize("../avail-rooms/".$_GET["roomnum"].".txt"));
        if(unserialize($room)->isStarted() == 0){
            $player->setAssignedRoom($_GET["roomnum"]);
            $_SESSION[$playerId] = serialize($player); 
            header("Location: ../view/queue-page.php?player-id=".$playerId."&room-code=".$_GET["roomnum"]);
        }else{
            echo "room is full!";
        }
    }else{
        echo "room not found 404";
    }
?>