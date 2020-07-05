<?php
$link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";

$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res);
mysqli_free_result($result);
mysqli_close($link);

if($list["numberOfPlayersRemaining"] < 3){
    $link = mysqli_connect("127.0.0.1", "root", "", "uno_online");
    $sql = "update room set isStarted='1' where roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    mysqli_free_result($result);
    mysqli_close($link);

    header("Location: ../view/game-play.php?player-name=".$_GET["player-name"]."&player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
}else{
    echo "Not enough players go back and wait for players to join.";
}
?>