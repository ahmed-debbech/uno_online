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
        <script>
        setTimeout(function(){window.location.reload(1);}, 2000);
        </script>
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
                        function setColors($text){
                            $colo = $text[strlen($text)-1];
                            switch($colo){
                                case 'r': return "#ff4747"; break;
                                case 'g': return "#6fc763"; break;
                                case 'b': return "#5496ff"; break;
                                case 'y': return "#eddc1c"; break;
                                default: return "grey"; break;
                            }
                        }
                        function __setColors($text){
                            switch($text){
                                case 'r': return "#ff4747"; break;
                                case 'g': return "#6fc763"; break;
                                case 'b': return "#5496ff"; break;
                                case 'y': return "#eddc1c"; break;
                                default: return "grey"; break;
                            }
                        }
                        echo "<p style='background-color: ".__setColors($list["color"])."; color: white;' id='cardOnTable'>".$list["cardOnTable"]."</p>";
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
            <input type="hidden" id="content_card" value="">
            <table>
                <tr>
                    <td>
                    <form method="post" action="core/game/get_from_Stack.php" onsubmit='return is_turn();'>
                        <input name="roomCode" type="hidden" value="<?php echo $_GET["room-code"]; ?>">
                        <input name="player-id" type="hidden" value="<?php echo $_SESSION["player_id"]; ?>">
                        <input type="submit" value="Stack">
                    </form>
                    <?php
                    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                    $sql = "select stackUsed from player where id='".$_SESSION["player_id"]."'";
                    $res = mysqli_query($link,$sql); 
                    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    mysqli_close($link);
                    if($row1["stackUsed"] == 1){
                        echo'<form method="post" action="core/game/passPressed.php">
                        <input name="roomCode" type="hidden" value="'.$_GET["room-code"].'">
                        <input name="player-id" type="hidden" value="'.$_SESSION["player_id"].'">
                        <input type="submit" value="Pass">
                        </form>';
                    }
                    ?>
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
                                echo "<form action='core/game/play-card.php' method='get' onsubmit='return is_turn();'>";
                                echo "<input type='hidden' name='room-code' value='".$_GET["room-code"]."'>";
                                echo "<input type='hidden' name='card-content' value='".$row["content"]."'>";
                                echo "<input type='hidden' name='player-id' value='".$_GET["player-id"]."'>";
                                echo "<button name='card' style='background-color: ".setColors($row["content"])."; color: white;' type='submit' onclick='setCont(\"".$row["content"]."\")' name='card' >".$row["content"]."</button>";
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
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Pick a color</h2>
                </div>
                <div class="modal-body">
                    <form action="core/game/play-card.php" method="get" >
                        <input name="color" id="pickedColor" type="hidden" value="">
                        <input type='hidden' name='room-code' value="<?echo $_GET["room-code"]?>">
                        <input type='hidden' id="con" name='card-content' value="">
                        <input type='hidden' name='player-id' value="<?echo $_GET["player-id"]?>">
                        <button type="submit"  onclick="document.getElementById('pickedColor').value = 'r';" style="background-color: #ff4747; padding: 50px;"></button>
                        <button type="submit" onclick="document.getElementById('pickedColor').value = 'g';" style="background-color: #6fc763; padding: 50px;"></button>
                        <button type="submit" onclick="document.getElementById('pickedColor').value = 'b';" style="background-color: #5496ff; padding: 50px;"></button>
                        <button type="submit"  onclick="document.getElementById('pickedColor').value = 'y';" style="background-color: #eddc1c; padding: 50px;"></button>
                    </form>
                </div>
                </div>
            </div>
        </center>
        <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementsByName('card');
        var r;
        for(var i=0; i<btn.length; i++){
            if((btn[i].innerHTML == "+4") || (btn[i].innerHTML == "wc")){
                btn[i].addEventListener("click", function(){modal.style.display = "block";})
            }
        }
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        validate.onclick = function() {
        modal.style.display = "none";
        }
        </script>
    <footer>Version: v0.1</footer>
    </body>
</html>