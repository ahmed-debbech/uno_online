<?php
//check if the game is ended
include_once("keys.php");
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select isEnded from room where roomCode='".$_GET["room-code"]."'";
$res = mysqli_query($link,$sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
if($row["isEnded"] == 1){
    header("Location: you_lost.php?room-code=".$_GET["room-code"]);
    exit();
}
mysqli_close($link);

//else show the page
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/game-play.js"></script>
    <script type="text/javascript" src="assets/js/ajax_gameplay.js"></script>
        <center>
            <table id="players">
                <tr>
                    <td>
                        <h4>Room: <?php echo $_GET["room-code"]?></h4>
                    </td>
                    <td><input id="turn" type="hidden" value=""></td>
                    <td>
                        <table id="pt" border="3px">
                        </table>
                    </td>
                </tr>
            </table>
            <table id="floor" border="3px">
                <tr>
                    <td>
                    <p id="cardOnTable" style="color: black;" id='cardOnTable'></p>
                    </td>
                </tr>
            </table>
            <h4>
               <p id="stat" style='color: #ff4747;'>YOUR TURN!</p>
               <p  id="stat-2">Click on a card to play</p>
            </h4>
            <input type="hidden" id="content_card" value="">
            <table>
                <tr>
                    <td>
                    <form method="post" action="core/game/get_from_stack.php" onsubmit='return is_turn();'>
                        <input id="rc" name="roomCode" type="hidden" value="<?php echo $_GET["room-code"]; ?>">
                        <input id="pl_id" name="player-id" type="hidden" value="<?php echo $_SESSION["player_id"]; ?>">
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
                    <td>
                    <table id="cards" border="2px">
                    </table>
                    </td>
                    <td>
                        You
                    </td>
                    <?php
                    //check the number of cards if it is 2
                    $con = mysqli_connect($serverIp, $username, $pass, $dbName);
                    $sql = "select count(*) as 'cout' from card where id='".$_GET["player-id"]."' and stack_id='".$_GET["room-code"]."'";
                    $result = mysqli_query($con, $sql);
                    $list = mysqli_fetch_array($result,MYSQLI_NUM);
                    if($list[0] == 2){
                        echo "<td><button onclick=\"location.href='core/game/uno_pressed.php?player-id=".$_GET["player-id"]."'\">UNO!</button></td>";
                    }
                    ?>
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
                        <input type='hidden' name='room-code' value="<?php echo $_GET["room-code"];?>">
                        <input type='hidden' id="con" name='card-content' value="">
                        <input type='hidden' name='player-id' value="<?php echo $_GET["player-id"];?>">
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

        </script>
    <footer>Version: v0.3.0</footer>
    </body>
</html>
