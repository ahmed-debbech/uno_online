<?php
    if($_GET["action"] == "create"){
        header("Location: ../identify.html");
    }else{
        header("Location: ../join-room.php");
    }
?>