<?php
include("../entities/room.php");
$fileName = "../avail-rooms/".$_GET["room-code"].".txt";
$file = fopen($fileName, "r");
$content = fread($file, filesize($fileName));
fclose($file);
$uncontent = unserialize($content);
$arr = $uncontent->getPlayers();
if(sizeof($arr) >= 1){
    header("Location: ../view/game-play.php?player-name=".$_GET["player-name"]."&player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
}else{
    echo "Not enough players go back and wait for players to join.";
}
?>