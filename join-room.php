<!DOCTYPE html>
<html>
<head>
	<title> Uno Online! - Join Room </title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="assets/css/join-room.css">
    <script src="assets/js/check-fields.js" type="text/javascript"></script>
</head>
<body>
  
  	 <div id="animated_div"><img src="assets/res/uno_logo.png" class="animated_div"> </div>
   <center>	
    
    <div class="name">
      <form action="core/fetch-room.php" method="get" onsubmit="return checkJoin();">
       <label for="fname"> <h1>Please write room code </h1></label>
       <input type="text" id="roomnum" name="roomnum" placeholder="..."> 
       <br>
       <label for="fname"> <h1>Please write your name </h1></label>
       <input type="text" id="player-name" name="player-name" placeholder="..."> 
       <br>
       <input type="submit" value="Pass">
      </form>
    </div>
    
   </center> 
   <footer>
            <h3 style="font-size: 12px;">An Ahmed Debbech Production © 2020.</h3>
            <h2 style="text-align: center; font-size: 14px;" id="designedby">Designed with love by Ons Kechrid</h2>
            </footer>
</body>
</html>