<?php 
    include("entities/player.php");
    include("entities/room.php");
    session_start(); 
    include_once("keys.php");
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/create-room.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="create-room.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/ajax_createroom_page.js"></script>
    </head>
    <body>

    <input type="hidden" value="<?php echo $_GET["player-id"];?>" id="playerI">
    <input type="hidden" value="<?php echo $_GET["room-code"];?>" id="roomC">

    <div id="animated_div"><img src="assets/res/uno_logo.png" class="animated_div"> </div>
        <center>
            
            <h1 class="room-code">Room code:  <?php echo $_GET["room-code"]?></h1>
            <br><br><br>

            <!-- *********************** avatar ************************* -->
           <div class="wrapper">
   <!-- <div class="border-circle" id="one"></div>
    <div class="border-circle" id="two"></div>-->
    <div class="background-circle">
      <div class="triangle-light"></div>
      <div class="body"></div>
      <span class="shirt-text">Give that code</span>
      <br>
      <span class="shirt-text">to your friends </span>
      <br>
      <span class="shirt-text"> to join you</span>
      <br>
      <span class="shirt-text">(max 4 players)</span>
      <br>
      <span class="shirt-text">ENJOY</span>
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
            <br>
            <h2 class="Players_remaining">Players remaining: <?php 
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                if (!$link) {
                    die('<strong>You were not able to connect to your database because ' . mysqli_error() . '</strong>');
                }
                $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                echo $row["numberOfPlayersRemaining"];
                mysqli_free_result($result);
                mysqli_close($link);
            ?></h2>

            <br>
           
            <table id="players">
              
              
            </table>

            </br></br></br></br>

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



            <h2 class="msg">Waiting for other players to join... <br>
            Press Start when you and your players are ready (max players is 4).</h2>
            <form action="core/check-players.php" method="get" onsubmit="return checkCreate();">
                <input type="hidden" name="room-code" value="<?php echo $_GET['room-code']?>">
                <input type="hidden" id="player-name" name="player-name" value="<?php echo $_GET["player-name"];?>"><br>
                <input type="hidden" id="player-id" name="player-id" value="<?php echo $_GET['player-id'];?>">
                <table>
                    <tr align="center">
                      <input onclick="document.getElementsByName('action')[0].value = 'join'; " type="submit" value="START"id="welbut">
                    </tr>
                </table>

            </form>
             </br></br></br></br>
             <footer>
            <h3 style="font-size: 12px; color: white;">An Ahmed Debbech Production © 2020.</h3>
            <h2 style="text-align: center; font-size: 14px;" id="designedby">Designed with love by Ons Kechrid</h2>
         </footer>
        </center>
    </body>
</html>