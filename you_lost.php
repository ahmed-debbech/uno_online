<?php 
session_start();
include_once("keys.php");
?>
<html>
    <head>
    <meta http-equiv="refresh" content="1; URL=core/check-started.php<?php echo '?room-code='.$_GET['room-code']."&player-id=".$_GET['player-id'];?>">
        <link rel="stylesheet" type="text/css" href="assets/css/create-room-theme.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
    </head>
    <center>
        <h1>
            <?php 
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select playerTurn from room where roomCode='".$_GET["room-code"]."'";
                $res = mysqli_query($link,$sql); 
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                mysqli_close($link);
            ?>
            <?php
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select name from player where id='".$row["playerTurn"]."'";
                $res = mysqli_query($link,$sql); 
                $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
                mysqli_close($link);
                echo "The winner is ".$row1["name"]." (id: ".$row["playerTurn"].")";
            ?> 
        </h1>
        <button onclick="location.href='index.html';">Go Back To Home Page</button>
    </center>
    <body>
    </body>
</html>