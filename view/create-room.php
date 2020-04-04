<?php 
include("../entities/player.php");
include("../entities/room.php");
session_start(); 
?>
<html>
    <head>
    <meta http-equiv="refresh" content="5; URL=create-room.php<?php echo '?room-code='.$_GET['room-code']."&player-id=".$_GET['player-id'];?>">
        <link rel="stylesheet" type="text/css" href="create-room-theme.css">
        <script src="check-fields.js" type="text/javascript"></script>
        <script src="refresher.js" type="text/javascript"></script>
    </head>
    <body>
        <center>
            <h1>Welcome To UNO Online :) enjoy!</h1>
            <h3 id="room-code" style="background-color: blue; color: whitesmoke;">Room code: <?php echo $_GET["room-code"]?></h3>
            <h4 style="color: white;">Give that code to your friends to join you (max 4 players)</h4>
            <h4 style="color: white;">Players remaining:
            <?php 
                $file = fopen("../avail-rooms/".$_GET["room-code"].".txt", "r");
                $c = fread($file, filesize("../avail-rooms/".$_GET["room-code"].".txt"));
                echo unserialize($c)->getRemaining();
                fclose($file);
            ?> </h4>
            <table border="3px">
                <tr>
                    <th>Player_ID</th>
                    <th>Name</th>
                </tr>
                <tr>
                    <td style='color: green;' ><?php echo $_GET["player-id"];?></td>
                    <td style='color: green;'>You</td>
                </tr>
                    <?php
                        $file = fopen("../avail-rooms/".$_GET["room-code"].".txt", "r");
                        $c = fread($file, filesize("../avail-rooms/".$_GET["room-code"].".txt"));
                        $serialized = unserialize($c);
                        $array = $serialized->getPlayers();
                        fclose($file);
                        for($i=0; $i<=sizeof($array)-1; $i++){
                            echo "<tr>";
                            echo "<td style='color: green;'>";
                            echo $array[$i]->getId();
                            echo "</td>";
                            echo "<td style='color: green;'>";
                            echo $array[$i]->getName();
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
            </table>
            <h2 style="color: white;">Waiting for other players to join... <br>
            Press Start to start game when you are satistifed with the number of players.</h2>
            <p style="color: white;">Write Down your name first:</p>
            <form action="../view/game-play.php" method="get" onsubmit="return checkCreate();">
                <input type="hidden" name="room-code" value="<?php echo $_GET['room-code']?>">
                <input type="text" id="player-name" name="player-name"><br>
                <input type="submit" id="start-button" value="Start">
            </form>
        </center>
    </body>
</html>