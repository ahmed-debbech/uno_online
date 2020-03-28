<?php
    if($_GET["action"] == "create"){
        header("Location: ../core/room-creation.php?player-name=".$_GET["player-name"]);
    }else{
        header("Location: ../view/join-room.php");
    }
?>