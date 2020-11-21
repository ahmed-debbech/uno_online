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
$sql = "select * from card where stack_id='".$_GET["room-code"]."' and id='".$_GET["player-id"]."'";
$res = mysqli_query($link,$sql); 
$list = mysqli_fetch_all($res, MYSQLI_ASSOC);
var_dump($list);
mysqli_close($link);
$r = "<tr>";
foreach($list as $row){
    $x = loadCard($row["content"]);
    $r .= "<td>";
    $r = $r ."<form action='core/game/play-card.php' method='get' name='formcard' onsubmit='return is_turn();'>".
    "<input type='hidden' name='room-code' value='".$_GET["room-code"]."'>".
     "<input type='hidden' name='card-content' value='".$row["content"]."'>".
     "<input type='hidden' name='player-id' value='".$_GET["player-id"]."'>".
     $x
     ."</form>".
     "</td>";
}
$r .= "</tr>";
echo $r;
?>