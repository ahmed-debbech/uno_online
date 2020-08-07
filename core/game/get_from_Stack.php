<?php
include("../../keys.php");
//get two cards from the stack to the next player
//get stack data
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from stack where stack_id='".$_POST["roomCode"]."'";
$res = mysqli_query($link,$sql); 
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);
//get next player id
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from player where id='".$_POST["player-id"]."'";
$res = mysqli_query($link,$sql); 
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);
$d = $row["numberOfCardsRemaining"];
$g = $row["nextCardNumber"];
//assign a card from stack to affected player
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "update card set id='".$_POST["player-id"]."' where order_in_stack=".$g." and stack_id='".$_POST["roomCode"]."'"; 
mysqli_query($link,$sql); 
mysqli_close($link);
//decrement the number of cards in stack
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$d--;
$g++;
$sql = "update stack set numberOfCardsRemaining=".$d.", nextCardNumber=".$g." where stack_id='".$_POST["roomCode"]."'"; 
mysqli_query($link,$sql); 
mysqli_close($link);

$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from room where roomCode='".$_POST["roomCode"]."'";
$res = mysqli_query($link,$sql); 
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);

//check if there's a compatible card before passing turn
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from card where stack_id='".$_POST["roomCode"]."' and id='".$_POST["player-id"]."'";
$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);
mysqli_close($link);

$found = false;
foreach($list as $row){
    if($row["content"] == "+4" || $row["content"] == "wc"){
    $found = true;
    }

    if($row1["cardOnTable"] == "+4" || $row1["cardOnTable"] == "wc"){
        if($row1["color"] == $row["content"][strlen($row["content"])-1] || $row1["color"] == NULL){
            break;
            $found = true;
        }
    }else{
        if($row1["color"] == $row["content"][strlen($row["content"])-1]){
        $found = true;
        }else{
            $i=0; $buff = "";
            do{ 
                $buff .= $row["content"][$i];
                $i++;
            }while($row["content"][$i] != "-");
            $i=0; $buff2 = "";

            do{ 
                $buff2 .= $row1["cardOnTable"][$i];
                $i++;
            }while($row1["cardOnTable"][$i]!= "-");
            if($buff == $buff2){
            $found = true;
            }
        }
    }
    
}
if($found == false){ // if no card is compatible after getting card from stack
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from player where id='".$_POST["player-id"]."'";
    $res = mysqli_query($link,$sql); 
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    mysqli_close($link);
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    if($row1["direction"] == 1){
        $sql = "update room set playerTurn='".$row["nextPlayer"]."' where roomCode='".$_POST["roomCode"]."'"; 
    }else{
        $sql = "update room set playerTurn='".$row["previousPlayer"]."' where roomCode='".$_POST["roomCode"]."'"; 
    }
    $res1 = mysqli_query($link,$sql); 
    mysqli_close($link);
}
header("Location: ".$_SERVER['HTTP_REFERER']);
?>