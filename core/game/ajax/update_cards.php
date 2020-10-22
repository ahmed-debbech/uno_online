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
function loadCard($content){
    $card = "";
    if($content[0] >= '0' && $content[0] <= '9'){
        $style1 = "border: 5px solid #E5E7E9;
            border-radius: 20px;
            height: 90px;
            width: 80px;
            margin: auto;";
        $style2 = "color: white;
                text-align: center;
                font-size: 50px;
                text-shadow: 8px 8px 16px #000000;
                padding-top: 500px;";
        $card = '<div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" style="'.$style1.' background-color: '.setColors($content).';" class="div_war9a_aadiyya">
            </br>
            <center> 
                <b style="'.$style2.'" class="war9a_aadiyya">'.$content[0].'</b> 
            </center>
            <img style="width: 25%; padding-left: 10px;" src="assets/res/logo.png" class="logo">
        </div> ';
    }else{
        if(stristr($content, "wc") == true){
            $card = ;
        }else{
            if(stristr($content, "+2") == true){
                $card= ;
            }else{
                if(stristr($content, "+4") == true){
                     $card = ;
                }else{
                    if(stristr($content, "inv") == true){
                        $card = ;
                    }else{
                        if(stristr($content, "blo") == true){
                            $card = ;
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
     //"<button name='card' style='background-color: ".setColors($row["content"])."; color: white;' type='submit' onclick='setCont(\"".$row["content"]."\")' name='card' >".$row["content"]."</button>".
     $x.
     "</form>".
     "</td>";
}
$r .= "</tr>";
echo $r;
?>