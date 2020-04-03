<?php
include("../entities/room.php");
    $fileName = "../avail-rooms/".$_GET["room-code"].".txt";
    $file = fopen($fileName, "r");
    $content = fread($file, filesize($fileName));
    $ucont = unserialize($content);
    fclose($file);
    if($ucont->isStarted() == 1){
        header("Location: ../view/game-play.php?player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
    }else{
        header("Location: ../view/queue-page.php?player-id=".$_GET["player-id"]."&room-code=".$_GET["room-code"]);
    }
?>