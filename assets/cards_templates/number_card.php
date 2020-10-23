<html>
    <head>
    <style>
        div.div_war9a_aadiyya{
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
        img.logo{
        width: 25%;
        padding-left: 10px; 
        }

    </style>
    </head>
    <body>
    <div onclick="setCont('<?php echo $_GET['content']; ?>'); this.parentNode.submit();" name="card" style="background-color: <?php echo "#".$_GET['color']; ?>;" class="div_war9a_aadiyya">
            </br>
            <center> 
                <b class="war9a_aadiyya"><?php echo $_GET['content']; ?></b> 
            </center>
            <img style="width: 25%; padding-left: 10px;" src="../res/logo.png" class="logo">
        </div> 
    </body>
</html>