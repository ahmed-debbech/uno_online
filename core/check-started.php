<?php
$link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";

$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res);

if($list["isStarted"] == 1){
    header("Location: ../game-play.php?player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
}else{
    header("Location: ../queue-page.php?player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
}
?>