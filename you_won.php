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
    </head>
    <center>
        <h1><?php echo $_SESSION["name"]?>, You Won!</h1>
        <button onclick="location.href='index.html';">Go Back To Home Page</button>
    </center>
    <body>
    </body>
</html>