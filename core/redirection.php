<?php
    if($_GET["action"] == "create"){
        $roomCode = rand(1000,9999);
        $roomCode .= "r";
        header("Location: ../view/create-room.php?code="."$roomCode");
    }else{
        header("Location: ../view/join-room.php");
    }
?>