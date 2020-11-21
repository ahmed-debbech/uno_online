<?php
function block($content, $col){
    return <<<HTML
    <html> 
        <head> 
        <style>
            div.div_war9a_block{
                border: 5px solid #E5E7E9;
                border-radius: 20px;
                height: 120px;
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
        </style> 
        </head>
        <body> 
            <div onclick="setCont('$content'); if(is_turn()==true){this.formcard[0].submit();}" name="card" style="background-color: $col;" class="div_war9a_block">
                </br>
                <div class="icon_block">
                    <center> 
                        <b class="war9a_block"><img src="assets/res/block.png" align="center" class="icon_block"></b> 
                    </center> 
                </div> 
                <img src="assets/res/logo.png" class="logo">
            </div>
        </body> 
    </html>
    HTML;
}
?>