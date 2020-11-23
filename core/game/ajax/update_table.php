<?php
include("../../../keys.php");

function setColors($text){
    $colo = $text[strlen($text)-1];
    switch($colo){
        case 'r': return "ff4747"; break;
        case 'g': return "6fc763"; break;
        case 'b': return "5496ff"; break;
        case 'y': return "eddc1c"; break;
        default: return "grey"; break;
    }
}
function loadCard($content){
    $card = "";
    if($content[0] >= '0' && $content[0] <= '9'){
        $col = setColors($content);
        include_once("../../../assets/cards_templates/number_card.php");
        $card = numbercard($content, "#".$col);
    }else{
        if(stristr($content, "wc") == true){
            include_once("../../../assets/cards_templates/wildcard.php");
            $card = wildcard();
        }else{
            if(stristr($content, "+2") == true){
                $col = setColors($content);
                include_once("../../../assets/cards_templates/plustwo.php");
                $card = plustwo($content, "#".$col);
            }else{
                if(stristr($content, "+4") == true){
                    include_once("../../../assets/cards_templates/plusfour.php");
                    $card = plusfour();
                }else{
                    if(stristr($content, "inv") == true){
                        $col = setColors($content);
                        include_once("../../../assets/cards_templates/inverse.php");
                        $card = inverse($content, "#".$col);
                    }else{
                        if(stristr($content, "blo") == true){
                            $col = setColors($content);
                            include_once("../../../assets/cards_templates/block.php");
                            $card = block($content, "#".$col);
                        }
                    }
                }
            }
        }
    }
    return $card;
}

$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select * from room where roomCode='".$_GET["room-code"]."'";
$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);

$cardOnTable = $list['cardOnTable'];
$ret = loadCard($cardOnTable);
// encoding array in JSON format
$return_arr = array();
$link = mysqli_connect($serverIp, $username, $pass, $dbName);
$sql = "select color from room where roomCode='".$_GET["room-code"]."'";
$res = mysqli_query($link,$sql);
$row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
mysqli_close($link);
$x="";
switch($row1['color']){
    case 'r': $x ="Red"; break;
    case 'g': $x = "Green"; break;
    case 'y': $x = "Yellow"; break;
    case 'b': $x = "Blue"; break;
}
$return_arr[] = array("cardOnTable" => $cardOnTable, "cardTemp" => $ret, "colorInd" => $x);

echo json_encode($return_arr);
?>