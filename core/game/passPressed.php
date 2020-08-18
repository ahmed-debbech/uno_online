<?php
include("../../keys.php");
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from room where roomCode='".$_POST["roomCode"]."'";
    $res = mysqli_query($link,$sql); 
    $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
    mysqli_close($link);

//set unoPressed flag to no
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "update player set unoPressed=0 where id='".$_GET["player-id"]."'"; 
$res1 = mysqli_query($link,$sql); 
mysqli_close($link);

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

 //set stackUsed flag to no
 $link = mysqli_connect($serverIp, $username, $pass, $dbName);
 $sql = "update player set stackUsed=0 where id='".$_POST["player-id"]."'"; 
 $res1 = mysqli_query($link,$sql); 
 mysqli_close($link);

 header("Location: ".$_SERVER['HTTP_REFERER']);

?>