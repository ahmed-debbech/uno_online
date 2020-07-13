<?php 
session_start();
include("entities/player.php");
include("entities/room.php");
include_once("keys.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/game-play-theme.css">
    </head>
    <body>
        <center>
            <table id="players">
                <tr>
                    <td>
                        <h4>Room Code: <?php echo $_GET["room-code"]?></h4>
                    </td>
                    <td>
                        <table border="3px">
                            <tr>
                                <?php
                                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                                $sql = "select * from player where roomCode='".$_GET["room-code"]."'";
                                $res = mysqli_query($link,$sql); 
                                $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                mysqli_close($link);

                                foreach($list as $row){
                                    if($row["name"] != $_SESSION["name"]){
                                        echo "<td>";
                                        echo $row["name"]." - Cards: ".$row["numCards"];
                                        echo "</td>";
                                    }
                                }
                                ?>
                            </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table id="floor" border="3px">
                <tr>
                    <td></td>
                </tr>
            </table>
            <h4>Click on a card to play</h4>
            <table>
                <tr>
                    <td>
                        <input type="button" value="Stack">
                    </td>
                    <td><table border="2px">
                        <tr> 
                            <td>
                            </td>
                        </tr>
                    </table></td>
                    <td>
                        You
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>