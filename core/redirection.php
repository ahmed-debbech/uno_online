<?php
    if($_GET["action"] == "create"){
        header("Location: ../core/room-creation.php");
    }else{
        header("Location: ../view/join-room.php");
    }
?>