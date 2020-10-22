<html>
    <head>
    <style>
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

    </style>
    </head>
    <body>
    <div onclick="setCont('<?php echo $_GET['content']; ?> '); this.formcard[0].submit();" name="card" style="background-color: '<?php echo $_GET['color']; ?>';"  class="div_war9a_plus2">
                    </br>
                    <div class="icon_plus2">
                        <b class="war9a_plus2"><img src="../res/two_cards.png" style="height: 50px;
                        width: 50px;" class="icon_plus2"></b> 
                    </div>  
                    <img src="../res/logo.png" class="logo"> 
                    </div>'
    </body>
</html>