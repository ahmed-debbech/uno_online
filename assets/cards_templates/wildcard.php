<html>
    <head>
    <style>
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

    </style>
    </head>
    <body>
    <div onclick="setCont('<?php echo $_GET['content']; ?> '); this.formcard[0].submit();"  name="card" class="div_war9et_4_colors">
                        <br>
                        <center>  <div class="circle_4_colors"></div> </center>
                    <img src="../res/logo.png" class="logo"> 
                    </div>'
    </body>
</html>