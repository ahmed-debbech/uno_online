<?php
function wildcard(){
    return <<<HTML
    <html>
        <head>
        <style>
            div.div_war9et_4_colors{
            background-color: black;
            border: 5px solid #E5E7E9;
            border-radius: 20px;
            height: 120px;
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

        </style>
        </head>
        <body>
        <div onclick="var modal = document.getElementById('myModal'); this.addEventListener('click', function(){modal.style.display = 'block';}); setCont('wc'); if(is_turn()==true){this.parentNode.submit();}"  name="card+" class="div_war9et_4_colors">
                            <br>
                            <center>  <div class="circle_4_colors"></div> </center>
                        <img src="assets/res/logo.png" class="logo"> 
                        </div>'
        </body>
    </html>
    HTML;
    }
?>