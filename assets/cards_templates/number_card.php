<?php
function numbercard($content, $color){
return <<<HTML
    <html>
    <head>
    <style>
        div.div_war9a_aadiyya{
        border: 5px solid #E5E7E9;
        border-radius: 20px;
        height: 120px;
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
        img.logo{
        width: 25%;
        padding-left: 10px; 
        }
    </style>
    </head>
    <body>
    <div onclick="setCont('$content'); if(is_turn()==true){this.parentNode.submit();}" name="card" style="background-color: $color;" class="div_war9a_aadiyya">
            </br>
            <center> 
                <b class="war9a_aadiyya">$content[0]</b> 
            </center>
            <img src="assets/res/logo.png" class="logo">
        </div> 
    </body>
</html>
HTML;
    }
?>