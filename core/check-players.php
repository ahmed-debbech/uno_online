<?php
include_once("../keys.php");
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";

$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res);
mysqli_close($link);

if($list["numberOfPlayersRemaining"] < 3){
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "update room set isStarted='1' where roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    mysqli_close($link);

    header("Location: ../game-play.php?player-name=".$_GET["player-name"]."&player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
}else{
    echo "Not enough players go back and wait for players to join.";
}
?>