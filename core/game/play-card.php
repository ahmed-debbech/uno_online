<?php
include_once("../../keys.php");
include_once("../../entities/game/card-handler.php");

//test on room existance
if(isset($_GET["room-code"]) && isset($_GET["player-id"]) && isset($_GET["card-content"])){
    if(((!isset($_GET["color"]))|| empty($_GET["color"])) && ($_GET["card-content"]=="+4" || $_GET["card-content"]=="wc")){
        die("400 Bad Request");
    }
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from player where id='".$_GET["player-id"]."' and roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    $num2= mysqli_num_rows($res);
    if($num2 == 0){
        die("400 Bad Request");
    }

    //test on card existance for given player with its card and its room
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from card where id='".$_GET["player-id"]."' and stack_id='".$_GET["room-code"]."' and content='".$_GET["card-content"]."'";
    $res = mysqli_query($link,$sql); 
    $num= mysqli_num_rows($res);
    if($num == 0){
        die("400 Bad Request");
    }
}else{
    die("400 Bad Request");
}
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from card where id='".$_GET["player-id"]."' and stack_id='".$_GET["room-code"]."' and content='".$_GET["card-content"]."'";
$res = mysqli_query($link,$sql); 
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);

if(isset($_GET["color"]) && (!empty($_GET["color"]))){
    $ch = new CardHandler($_GET["room-code"], $_GET["player-id"], $_GET["card-content"], $row["number"]);
    $ch->setColor($_GET["color"]);
}else{
    $ch = new CardHandler($_GET["room-code"], $_GET["player-id"], $_GET["card-content"], $row["number"]);
}

if($ch->isCompatible()){
        $ch->updateCardOnTable();
        $ch->managePlayerCards();
        $ch->passTurn();
        /*if($ch->isActionCard()){

        }*/
}else{
    //header("Location: ".$_SERVER['HTTP_REFERER']);
    echo "wrong card played! please go back to the previous page.";
}
?>