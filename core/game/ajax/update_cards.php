<?php
include("../../../keys.php");
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
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from card where stack_id='".$_GET["room-code"]."' and id='".$_GET["player-id"]."'";
$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);
var_dump($list);
mysqli_close($link);
$r = "<tr>";
foreach($list as $row){
    $r .= "<td>";
    $r = $r ."<form action='core/game/play-card.php' method='get' onsubmit='return is_turn();'>".
    "<input type='hidden' name='room-code' value='".$_GET["room-code"]."'>".
     "<input type='hidden' name='card-content' value='".$row["content"]."'>".
     "<input type='hidden' name='player-id' value='".$_GET["player-id"]."'>".
     "<button name='card' style='background-color: ".setColors($row["content"])."; color: white;' type='submit' onclick='setCont(\"".$row["content"]."\")' name='card' >".$row["content"]."</button>".
     "</form>".
     "</td>";
}
$r .= "</tr>";
echo $r;
?>