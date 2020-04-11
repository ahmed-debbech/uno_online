<?php
    if($_GET["action"] == "create"){
        header("Location: ../view/identify.html");
    }else{
        header("Location: ../view/join-room.php");
    }
?>