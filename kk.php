<?php 
    include("entities/player.php");
    include("entities/room.php");
    session_start(); 
    include_once("keys.php");
?>
<html>
    <head>
    <meta http-equiv="refresh" content="5; URL=create-room.php<?php echo '?room-code='.$_GET['room-code']."&player-id=".$_GET['player-id']."&player-name=".$_GET["player-name"];?>">
        <link rel="stylesheet" type="text/css" href="assets/css/create-room-theme.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
        <script src="assets/js/refresher.js" type="text/javascript"></script>
    </head>
    <body>
        <center>
            <h1>Welcome To UNO Online :) enjoy!</h1>
            <h3 id="room-code" style="background-color: blue; color: whitesmoke;">Room code: <?php echo $_GET["room-code"]?></h3>
            <h4 style="color: white;">Give that code to your friends to join you (max 4 players)</h4>
            <h4 style="color: white;">Players remaining:         
             <?php 
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                if (!$link) {
                    die('<strong>You were not able to connect to your database because ' . mysqli_error() . '</strong>');
                }
                $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo $row["numberOfPlayersRemaining"];
                mysqli_free_result($result);
                mysqli_close($link);
            ?></h4>
            <table border="3px">
                <tr>
                    <th>Player_ID</th>
                    <th>Name</th>
                </tr>
                    <?php
                        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                        if (!$link) {
                            die('<strong>You were not able to connect to your database because ' . mysqli_error() . '</strong>');
                        }
                        $sql = "select * from player where roomCode='".$_GET["room-code"]."'";
                        $result = mysqli_query($link, $sql);
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach($row as $array){
                            echo "<tr>";
                            echo "<td style='color: green;'>";
                            echo $array["id"];
                            echo "</td>";
                            echo "<td style='color: green;'>";
                            echo $array["name"];
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
            </table>
            <h2 style="color: white;">Waiting for other players to join... <br>
            Press Start to start game when you are satistifed with the number of players.</h2>
            <form action="core/check-players.php" method="get" onsubmit="return checkCreate();">
                <input type="hidden" name="room-code" value="<?php echo $_GET['room-code']?>">
                <input type="hidden" id="player-name" name="player-name" value="<?php echo $_GET["player-name"];?>"><br>
                <input type="hidden" id="player-id" name="player-id" value="<?php echo $_GET['player-id'];?>">
                <input type="submit" id="start-button" value="Start">
            </form>
        </center>
    </body>
</html>