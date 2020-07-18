<?php 
session_start();
include("entities/player.php");
include("entities/room.php");
include_once("keys.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/game-play-theme.css">
        <script type="text/javascript" src="assets/js/game-play.js"></script>
        <!--<script>
        setTimeout(function(){window.location.reload(1);}, 2000);
        </script>-->
    </head>
    <body>
        <center>
            <table id="players">
                <tr>
                    <td>
                        <h4>Room: <?php echo $_GET["room-code"]?></h4>
                    </td>
                    <td><input id="turn" type="hidden" value="<?php
                    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                    $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                    $res = mysqli_query($link,$sql); 
                    $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    mysqli_close($link);
                    if($list["playerTurn"] == $_SESSION["player_id"]){
                        echo "1";
                    }else{
                        echo "0";
                    }
                    ?>"></td>
                    <td>
                        <table border="3px">
                            <tr>
                                <?php
                                function sort_for_dir($list){ 
                                    $ap = array();
                                    for($i=0; $i<count($list); $i++){
                                        if($_SESSION["player_id"] == $list[$i]["id"]){
                                            array_push($ap, $list[$i]);
                                        }
                                    }
                                    for($i=0; $i<count($list); $i++){
                                        for($j=0; $j<count($list); $j++){
                                            if($ap[$i]["nextPlayer"] == $list[$j]["id"]){
                                                if($ap[0]["id"] != $list[$j]["id"]){
                                                    array_push($ap, $list[$j]);
                                                }
                                            }
                                        }
                                    }
                                    return $ap;
                                } 
                                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                                $sql = "select * from player where roomCode='".$_GET["room-code"]."'";
                                $res = mysqli_query($link,$sql); 
                                $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                mysqli_close($link);

                                $ap = array();
                                $ap = sort_for_dir($list);

                                function getColor($id){
                                    include("keys.php");
                                    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                                    $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                                    $res = mysqli_query($link,$sql); 
                                    $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
                                    mysqli_close($link);
                                    if($id == $list[0]["playerTurn"]){
                                        return "red";
                                    }else{
                                        return "black";
                                    }
                                }

                                foreach($ap as $row){
                                    if($row["id"] != $_SESSION["player_id"]){
                                        echo "<td>";
                                        echo "<p style='color: ".getColor($row["id"]).";'>".$row["name"]." - Cards: ".$row["numCards"]."</p>";
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
                    <td>
                    <?php
                        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                        $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                        $res = mysqli_query($link,$sql); 
                        $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
                        mysqli_close($link);
                        echo "<p id='cardOnTable'>".$list["cardOnTable"]."</p>";
                    ?>
                    </td>
                </tr>
            </table>
            <h4>
            <?php 
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                $res = mysqli_query($link,$sql); 
                $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
                mysqli_close($link);
                if($list["playerTurn"] == $_SESSION["player_id"]){
                    echo "<p style='color: red;'>YOUR TURN!</p>";
                    echo "<p>Click on a card to play</p>";
                }
            ?>
            </h4>
            <input type="hidden" id="content_card">
            <table>
                <tr>
                    <td>
                        <input type="button" value="Stack">
                    </td>
                    <td><table border="2px">
                        <tr> 
                        <?php
                            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                            $sql = "select * from card where stack_id='".$_GET["room-code"]."' and id='".$_GET["player-id"]."'";
                            $res = mysqli_query($link,$sql); 
                            $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
                            mysqli_close($link);
                            
                            foreach($list as $row){
                                echo "<td>";
                                echo "<form action='core/game/play-card.php' method='post' onsubmit='return is_turn();'>";
                                echo "<input type='button' onclick='document.getElementById(\'content_card\').value = ".$row["content"]."; this.form.submit();' name='card' value='".$row["content"]."'>";
                                echo "</form>";
                                echo "</td>";
                            }
                        ?>
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