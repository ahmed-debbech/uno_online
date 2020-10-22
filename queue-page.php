<?php 
session_start();
include_once("entities/player.php");
include_once("keys.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="queue-page.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
        <script src="assets/js/refresher.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="assets/css/queue-page.css">
    </head>
    <center>
    <div id="animated_div"><img src="assets/res/uno_logo.png" class="animated_div"> </div>
        <h1>Welcome to the room, <?php
          $link = mysqli_connect($serverIp, $username, $pass, $dbName);
          $sql = "select * from player where id='".$_GET["player-id"]."'";
          $res = mysqli_query($link,$sql); 
          $list = mysqli_fetch_array($res);
          echo $list["name"];
          ?>
        </h1>
        <br><br>

     <!-- *********************** avatar ************************* -->
        <div class="wrapper">
            <div class="background-circle">
                <div class="triangle-light"></div>
                <div class="body"></div>
                <span class="shirt-text">You are in room:</span>
                <br>
                <span class="shirt-text">4026r </span>
                <br>
                <div class="triangle-dark"></div>
            </div>
            <div class="head">
               <div class="ear" id="left"></div>
               <div class="ear" id="right"></div>

                <div class="hair-main">
                 <div class="sideburn" id="left"></div>
                 <div class="sideburn" id="right"></div>
                 <div class="hair-top"></div>
               </div>
      
               <div class="face">
                <div class="nose"></div>
                <!--<div class="glasses1">
                 <div class="glass1"></div>
                </div>
                <div class="glasses2">
                   <div class="glass2"></div>
                </div>-->
                <div class="eye-shadow" id="left">
                  <div class="eyebrow"></div>
                  <div class="eye"></div>
                </div>
        
                <div class="eye-shadow" id="right">
                  <div class="eyebrow"></div>
                  <div class="eye"></div>
                </div>

                <div class="le7ya"></div>
                <div class="ta7t_le7ya"></div>
                <div class="circle_le7ya"></div>
                <div class="mouth"></div>
                <div class="shadow-wrapper">
                    <div class="shadow"></div>
                </div>

             </div>
            </div>
        </div>

          <br><br>
          <h2 class="msg">You player id is: <?php echo $_GET["player-id"]; ?></h2>
          <br><br>
         <!-- Hand animation -->
             <div class="loading" align="center">
               <div class="finger finger-1">
                 <div class="finger-item">
                   <span></span>
                   <i></i>
                 </div>
               </div>
               <div class="finger finger-2">
                <div class="finger-item">
                   <span></span>
                   <i></i>
                 </div>
               </div>
               <div class="finger finger-3">
                <div class="finger-item">
                  <span></span>
                   <i></i>
                 </div>
               </div>
               <div class="finger finger-4">
                 <div class="finger-item">
                   <span></span>
                   <i></i>
                 </div>
               </div>
              <div class="last-finger">
                 <div class="last-finger-item">
                   <span></span>
                   <i></i>
                 </div>
               </div>
             </div>

        <h1>You are in room: <?php echo $_GET["room-code"]; ?></h1>
        <h2 class="msg">Please wait until the room creator starts the match...</h2>
        <h4 style="color: white;">You player id is: <?php echo $_GET["player-id"]; ?></h4>

          </br></br></br></br>
             <footer>
            <h3 style="font-size: 12px; color: white;">An Ahmed Debbech Production © 2020.</h3>
            <h2 style="text-align: center; font-size: 14px;" id="designedby">Designed with love by Ons Kechrid</h2>
         </footer>
       
    </center>
    <body>
    </body>
</html>