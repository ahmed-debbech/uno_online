<?php 
    include("../../../keys.php");
    session_start();
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
    mysqli_close($link);
    if($list["playerTurn"] == $_SESSION["player_id"]){
        echo "0";
    }else{
        echo "1";
    }
?>