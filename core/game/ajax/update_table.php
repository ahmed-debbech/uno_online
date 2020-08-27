<?php
include("../../../keys.php");
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";
$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);
function __setColors($text){
    switch($text){
        case 'r': return "#ff4747"; break;
        case 'g': return "#6fc763"; break;
        case 'b': return "#5496ff"; break;
        case 'y': return "#eddc1c"; break;
        default: return "grey"; break;
    }
}

$return_arr = array();

$color = __setColors($list["color"]);
$cardOnTable = $list['cardOnTable'];
$return_arr[] = array("color" => $color,
                    "cardOnTable" => $cardOnTable
                );

// encoding array in JSON format
echo json_encode($return_arr);
?>