<html> <head> <style>
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
                        <div onclick="setCont('<?php echo $_GET['content']; ?> '); this.parentNode.submit();" name="card" style="background-color: '<?php echo $_GET["color"];?>';" class="div_war9a_inverse">
                        </br>
                        <div class="icon_inverse">
                        <center> 
                            <b class="war9a_inverse"><img src="../res/inverse.png" align="center" class="icon_inverse"></b> 
                        </center> 
                        </div> 
                        <img src="../res/logo.png" class="logo">
                        </div></body> </html>