<?php
    session_start();
    include("../entities/room.php");
    include_once("../entities/player.php");
    function checkPlayerIdIntegrity($x){
        foreach($_SESSION as $player){
            if(unserialize($player)->getId() == $x){
                return 0;
            }
        }
        return 1;
    }
    function checkRoomIdIntegrity($x){
        $file = fopen("../avail-rooms/".$x.".txt", "r");
        if($file == FALSE){
            return 1;
        }else{
            return 0;
        }
    }
    do{
        $playerId = rand(1000,9999);
        $playerId .= "p";
    }while(checkPlayerIdIntegrity($playerId) == 0);
    do{
        $roomCode = rand(1000,9999);
        $roomCode .= "r";
    }while(checkRoomIdIntegrity($roomCode) == 0);
    $initialPlayer = new Player($_GET["player-name"],$playerId,$roomCode);
    $_SESSION[$playerId] = serialize($initialPlayer); 
    $room = new Room($roomCode, $initialPlayer);
    $room->addRoomToDB();
    header("Location: ../view/create-room.php?room-code=".$room->getRoomCode()."&player-id=".$initialPlayer->getId());
?>  
