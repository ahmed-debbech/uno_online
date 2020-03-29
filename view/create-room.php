<?php 
include("../entities/player.php");
session_start(); ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="create-room-theme.css">
        <script src="check-fields.js" type="text/javascript"></script>
    </head>
    <body>
        <center>
            <h1>Welcome To UNO Online :) enjoy!</h1>
            <h3 id="room-code" style="background-color: blue; color: whitesmoke;">Room code: <?php echo $_GET["room-code"]?></h3>
            <h4 style="color: white;">Give that code to your friends to join you (max 4 players)</h4>
            <h4 style="color: white;">Players remaining: 99</h4>
            <table border="3px">
                <tr>
                    <th>Player_ID</th>
                    <th>Name</th>
                </tr>
                <tr>
                    <td style="color: green;"><?php echo $_GET["player-id"];?></td>
                    <td style="color: green;"><?php 
                    echo unserialize($_SESSION[$_GET["player-id"]])->getName();
                    ?></td>
                </tr>
            </table>
            <h2 style="color: white;">Waiting for other players to join... <br>
            Press Start to start game when you are satistifed with the number of players.</h2>
            Write Down your name first:
            <form action="../view/game-play.php" method="get" onsubmit="return checkCreate();">
                <input type="hidden" name="room-code" value="<?php echo $_GET['code']?>">
                <input type="text" id="player-name" name="player-name"><br>
                <input type="submit" id="start-button" value="Start">
            </form>
        </center>
    </body>
</html>