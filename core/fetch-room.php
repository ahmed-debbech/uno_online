<?php
    session_start();
    include_once("../entities/room.php");
    include_once("../keys.php");
    function checkIntegrity($x){
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
    function checkRoomAvailable($x){
        $link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
        $sql = "select * from room where roomCode='".$x."'";
        $m=0;
        $res = mysqli_query($link,$sql, $m); 
        $num= mysqli_num_rows($res);
        if($num == 0){
            return false;
        }
        return true;
    }
    function getRemaining($x){
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from room where roomCode='".$x."'";
        $res = mysqli_query($link,$sql); 
        $list = mysqli_fetch_array($res);
        return $list["numberOfPlayersRemaining"];
    }
    if(checkRoomAvailable($_GET["roomnum"])){
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $x = getRemaining($_GET["roomnum"])-1;
        if($x > -1){
            $sql = "update room set numberOfPlayersRemaining='".$x."' where roomCode='".$_GET["roomnum"]."'";
            $res = mysqli_query($link,$sql); 
            do{
                $playerId = rand(1000,9999);
                $playerId .= "p";
            }while(checkIntegrity($playerId) == 0);
            $player = new Player($_GET["player-name"],$playerId,$_GET["roomnum"]);
            $player->addPlayerToDB();
            $_SESSION["name"] = $player->getName();
            $_SESSION["player_id"] = $player->getId();
            header("Location: ../queue-page.php?player-id=".$playerId."&room-code=".$_GET["roomnum"]);
        }else{
            echo "Room is full!";
        }
    }else{
        echo "room not found 404";
    }
?>