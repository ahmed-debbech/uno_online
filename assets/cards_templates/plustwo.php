<?php
function plustwo($content, $col){
    return <<<HTML
    <html>
        <head>
        <style>
            div.div_war9a_plus2{
                border: 5px solid #E5E7E9;
                border-radius: 20px;
                height: 120px;
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

        </style>
        </head>
        <body>
            <div onclick="setCont('$content'); if(is_turn()==true){this.parentNode.submit();}" name="card" style="background-color: $col;"  class="div_war9a_plus2">
                </br>
                <div class="icon_plus2">
                    <b class="war9a_plus2"><img src="assets/res/two_cards.png" style="height: 50px; width: 50px;" class="icon_plus2"></b> 
                </div>  
                <img src="assets/res/logo.png" class="logo"> 
            </div>
        </body>
    </html>
HTML;
    }
?>