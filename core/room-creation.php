<?php
    session_start();
    include("../entities/room.php");
    include_once("../entities/player.php");
    function checkPlayerIdIntegrity($x){
        $link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
        $sql = "select * from player where id='".$x."'";
        $m=0;
        $res = mysqli_query($link,$sql, $m); 
        $num= mysqli_num_rows($res);
        if($num == 0){
            return 1;
        }
        return 0;
    }
    function checkRoomIdIntegrity($x){
        $link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
        $sql = "select * from room where roomCode='".$x."'";
        $m=0;
        $res = mysqli_query($link,$sql, $m); 
        $num= mysqli_num_rows($res);
        if($num == 0){
            return 1;
        }
        return 0;
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
    $room = new Room($roomCode, $initialPlayer);
    $room->addRoomToDB();
    $_SESSION["player_id"] = $initialPlayer->getId();
    $_SESSION["name"] = $initialPlayer->getName();
    $initialPlayer->addPlayerToDB();
    header("Location: ../create-room.php?room-code=".$room->getRoomCode()."&player-id=".$initialPlayer->getId()."&player-name=".$initialPlayer->getName());
?>  
