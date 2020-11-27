<?php
include_once("../keys.php");
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";

$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res);

$x="";
if($list["isStarted"] == 1){
    $x = "1";
}else{
    $x = "2";
}
$return_arr = array();
$return_arr[] = array("start" => $x
            );

// encoding array in JSON format
echo json_encode($return_arr);
?>