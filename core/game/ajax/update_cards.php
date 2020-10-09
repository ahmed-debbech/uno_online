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
        $card = '<html> <head> <style> div.div_war9a_aadiyya{
            border: 5px solid #E5E7E9;
            border-radius: 20px;
            height: 90px;
            width: 80px;
            margin: auto;
         }
          .war9a_aadiyya{
              color: white;
                text-align: center;
                font-size: 50px;
                text-shadow: 8px 8px 16px #000000;
             /*position: absolute;  */ 
             padding-top: 500px;
            }
         
         /*********************** logo ******************/
         
         img.logo{
           width: 25%;
           padding-left: 10px; 
         } </style> </head> <body> 
         <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" style="background-color: '.setColors($content).';" class="div_war9a_aadiyya">
            </br>
            <center> 
                <b class="war9a_aadiyya">'.$content[0].'</b> 
            </center>
            <img src="assets/res/logo.png" class="logo">
        </div> </body> </html>';
    }else{
        if(stristr($content, "wc") == true){
            $card = '<html> <head> <style>
                div.div_war9et_4_colors{
                    background-color: black;
                    border: 5px solid #E5E7E9;
                    border-radius: 20px;
                    height: 90px;
                    width: 80px;
                }
                .circle_4_colors{
                    
                    width: 10px;
                    height: 10px;
                    border-radius: 50%;
                    background-color: black;
                    border-top: 20px solid #ed1c24;
                    border-right: 20px solid green;
                    border-bottom: 20px solid yellow;
                    border-left: 20px solid #0F0C93;
                }
                </style> </head> <body> 
                    <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" class="div_war9et_4_colors">
                        <br>
                        <center>  <div class="circle_4_colors"></div> </center>
                    <img src="assets/res/logo.png" class="logo"> 
                    </div></body> </html>';

        }else{
            if(stristr($content, "+2") == true){
                $card =  '<html> <head> <style>
                    div.div_war9a_plus2{
                        border: 5px solid #E5E7E9;
                        border-radius: 20px;
                        height: 90px;
                        width: 80px;
                        margin: auto;
                    }
                    div.icon_plus2{
                        border: 5px solid;
                        border-radius: 50px;
                        height: 50px;
                        width: 50px;
                    
                        animation: mymove 2s infinite;
                    } 
                    @keyframes mymove {
                    50% {box-shadow: 4px 8px 10px white;}
                    }
                    
                    img.icon_plus2{
                        height: 50px;
                        width: 50px; 
                    }
                    
                    </style> </head> <body> 
                    <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" style="background-color: '.setColors($content).';"  class="div_war9a_plus2">
                    </br>
                    <div class="icon_plus2">
                        <b class="war9a_plus2"><img src="assets/res/two_cards.png" class="icon_plus2"></b> 
                    </div>  
                    <img src="assets/res/logo.png" class="logo"> 
                    </div></body> </html>';

            }else{
                if(stristr($content, "+4") == true){
                     $card = '<html> <head> <style>
                    div.div_war9a_plus4{
                        border: 5px solid #E5E7E9;
                        border-radius: 20px;
                        height: 90px;
                        width: 80px;
                        background-color: black;
                        margin: auto;
                      }
                     div.icon_plus4{
                        border: 5px solid red;
                        border-radius: 50px;
                        height: 50px;
                        width: 50px;
                     
                         animation: mymove 2s infinite;
                     } 
                     @keyframes mymove {
                       50% {box-shadow: 4px 8px 10px white;}
                     }
                     
                     img.icon_plus4{
                        height: 50px;
                        width: 50px;
                     }
                    </style> </head> <body> 
                    <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" class="div_war9a_plus4">
                    </br>
                    <div class="icon_plus4">
                    <center> 
                        <b class="war9a_plus4"><img src="assets/res/four_cards.png" class="icon_plus4"></b> 
                    </center> 
                    </div>  
                    <img src="assets/res/logo.png" class="logo"> 
                    </div></body> </html>';
                }else{
                    if(stristr($content, "inv") == true){
                        $card = '<html> <head> <style>
                        div.div_war9a_inverse{
                            border: 5px solid #E5E7E9;
                            border-radius: 20px;
                            height: 90px;
                            width: 80px;
                            margin: auto;
                            }
                            
                            div.icon_inverse{
                            border: 5px solid #E5E7E9;
                            border-radius: 50px;
                            height: 50px;
                            width: 50px;
                            
                                animation: mymove 2s infinite;
                            } 
                            @keyframes mymove {
                            50% {box-shadow: 4px 8px 10px white;}
                            }
                            
                            img.icon_inverse{
                            height: 50px;
                            width: 50px;
                            }
                        </style> </head> <body> 
                        <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" style="background-color: '.setColors($content).';" class="div_war9a_inverse">
                        </br>
                        <div class="icon_inverse">
                        <center> 
                            <b class="war9a_inverse"><img src="assets/res/inverse.png" align="center" class="icon_inverse"></b> 
                        </center> 
                        </div> 
                        <img src="assets/res/logo.png" class="logo">
                        </div></body> </html>';
                    }else{
                        if(stristr($content, "blo") == true){
                            $card = '<html> <head> <style>
                            div.div_war9a_block{
                                border: 5px solid #E5E7E9;
                                border-radius: 20px;
                                height: 90px;
                                width: 80px; 
                            }
                            
                            div.icon_block{
                                border: 5px solid #E5E7E9;
                                border-radius: 50px;
                                height: 50px;
                                width: 50px;
                            
                                animation: mymove 2s infinite;
                            } 
                            @keyframes mymove {
                            50% {box-shadow: 4px 8px 10px white;}
                            }
                            
                            img.icon_block{
                                height: 50px;
                                width: 50px;
                            }
                            
                            </style> </head> <body> 
                            <div onclick="setCont('.$content.'); this.parentNode.submit();" name="card" style="background-color: '.setColors($content).';" class="div_war9a_block">
                            
                            </br>
                            <div class="icon_block">
                            <center> 
                                <b class="war9a_block"><img src="assets/res/block.png" align="center" class="icon_block"></b> 
                            </center> 
                            </div> 
                            <img src="assets/res/logo.png" class="logo">
                            </div></body> </html>';
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
    $r = $r ."<form action='core/game/play-card.php' method='get' onsubmit='return is_turn();'>".
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