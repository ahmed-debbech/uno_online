<?php
include_once("../../keys.php");
include_once("../../entities/game/card-handler.php");
include_once("../../entities/game/action-card.php");

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
        if($ch->isActionCard() == false){
            $ch->passTurn();
        }else{
            if(isset($_GET["color"]) && (!empty($_GET["color"]))){
                $ac = new ActionCard($_GET["room-code"], $_GET["player-id"], $_GET["card-content"], $row["number"]);
                $ac->setColor($_GET["color"]);
            }else{
                $ac = new ActionCard($_GET["room-code"], $_GET["player-id"], $_GET["card-content"], $row["number"]);
            }
            $ac->applyActionCard();
        }
        //set stackUsed flag to no
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "update player set stackUsed=0 where id='".$_GET["player-id"]."'"; 
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);
        //check if player finished all cards
        $con = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select count(*) as 'cout' from card where id='".$_GET["player-id"]."' and stack_id='".$_GET["room-code"]."'";
        $result = mysqli_query($con, $sql);
        $list = mysqli_fetch_array($result,MYSQLI_NUM);
        if($list[0] >= 2){
            //set unoPressed flag to no
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "update player set unoPressed=0 where id='".$_GET["player-id"]."'"; 
            $res1 = mysqli_query($link,$sql); 
            mysqli_close($link);
        }
        if($list[0] == 1){
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "select * from player where id='".$_GET["player-id"]."'";
            $res = mysqli_query($link,$sql); 
            $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
            mysqli_close($link);
            if($row["unoPressed"] == 0){
                //get two cards from the stack to the next player
                //get stack data
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select * from stack where stack_id='".$_GET["room-code"]."'";
                $res = mysqli_query($link,$sql); 
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                mysqli_close($link);
                //get next player id
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select * from player where id='".$_GET["player-id"]."'";
                $res = mysqli_query($link,$sql); 
                $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
                mysqli_close($link);
                $d = $row["numberOfCardsRemaining"];
                $g = $row["nextCardNumber"];
                for($i=0; $i<2; $i++){
                    //assign a card from stack to affected player
                    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                    $sql = "update card set id='".$_GET["player-id"]."' where order_in_stack=".$g." and stack_id='".$_GET["room-code"]."'"; 
                    mysqli_query($link,$sql); 
                    mysqli_close($link);
                    //decrement the number of cards in stack
                    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                    $d--;
                    $g++;
                    $sql = "update stack set numberOfCardsRemaining=".$d.", nextCardNumber=".$g." where stack_id='".$_GET["room-code"]."'"; 
                    mysqli_query($link,$sql); 
                    mysqli_close($link);
                }
            }
        }
        if($list[0] == 0){
            //set isEnded flag after the game is finished
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "update room set isEnded=1 where roomCode='".$_GET["room-code"]."'"; 
            $res1 = mysqli_query($link,$sql); 
            mysqli_close($link);
            header("Location: ../../you_won.php");
        }else{
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
}else{
    //header("Location: ".$_SERVER['HTTP_REFERER']);
    echo "wrong card played! please go back to the previous page.";
}
?>