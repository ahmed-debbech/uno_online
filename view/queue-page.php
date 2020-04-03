<?php 
session_start();
include_once("../entities/player.php");
?>
<html>
    <head>
    <meta http-equiv="refresh" content="1; URL=../core/check-started.php<?php echo '?room-code='.$_GET['room-code']."&player-id=".$_GET['player-id'];?>">
        <link rel="stylesheet" type="text/css" href="create-room-theme.css">
        <script src="check-fields.js" type="text/javascript"></script>
        <script src="refresher.js" type="text/javascript"></script>
    </head>
    <center>
        <h1>Welcome to the room, <?php echo unserialize($_SESSION[$_GET["player-id"]])->getName();?></h1>
        <h1>You are in room: <?php echo $_GET["room-code"]; ?></h1>
        <h4 style="color: white;">Please wait until the room creator submits the list of joined players.</h4>
        <h4 style="color: white;">You player id is: <?php echo $_GET["player-id"]; ?></h4>
        <h1 style="text-align: center; color: blue;">Please wait...</h1>
    </center>
    <body>
    </body>
</html>