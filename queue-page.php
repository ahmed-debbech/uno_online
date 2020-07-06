<?php 
session_start();
include_once("entities/player.php");
include_once("keys.php");
?>
<html>
    <head>
    <meta http-equiv="refresh" content="1; URL=core/check-started.php<?php echo '?room-code='.$_GET['room-code']."&player-id=".$_GET['player-id'];?>">
        <link rel="stylesheet" type="text/css" href="assets/css/create-room-theme.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
        <script src="assets/js/refresher.js" type="text/javascript"></script>
    </head>
    <center>
        <h1>Welcome to the room, <?php
         $link = mysqli_connect($serverIp, $username, $pass, $dbName);
         $sql = "select * from player where id='".$_GET["player-id"]."'";
         $res = mysqli_query($link,$sql); 
         $list = mysqli_fetch_array($res);
         echo $list["name"];
         ?></h1>
        <h1>You are in room: <?php echo $_GET["room-code"]; ?></h1>
        <h4 style="color: white;">Please wait until the room creator submits the list of joined players.</h4>
        <h4 style="color: white;">You player id is: <?php echo $_GET["player-id"]; ?></h4>
        <h1 style="text-align: center; color: blue;">Please wait...</h1>
    </center>
    <body>
    </body>
</html>