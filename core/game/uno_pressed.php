<?php
include("../../keys.php");
//set unoPressed flag to yes
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "update player set unoPressed=1 where id='".$_GET["player-id"]."'"; 
$res1 = mysqli_query($link,$sql); 
mysqli_close($link);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>