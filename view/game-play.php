<?php 
session_start();
include("../entities/player.php");
include("../entities/room.php");
$fileName = "../avail-rooms/".$_GET["room-code"].".txt";
$file = fopen($fileName, "r");
$content = fread($file, filesize($fileName));
$ucont = unserialize($content);
fclose($file);
$ucont->setStarted();
$file = fopen($fileName, "w");
fwrite($file, serialize($ucont));
fclose($file);
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="game-play-theme.css">
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
                                <td>Not Available - rest: 0</td>
                                <td>Not Available - rest: 0</td>
                                <td>Not Available - rest: 0</td>
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