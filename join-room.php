<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/theme.css">
        <script src="assets/js/check-fields.js" type="text/javascript"></script>
    </head>
    <body>
        <center>
            <h1>Welcome To UNO Online :) enjoy!</h1>
            <form action="core/fetch-room.php" method="get" onsubmit="return checkJoin();">
                 <h3>Join an existing Room by writing the room code</h3>
                <input type="text" id="roomnum" name="roomnum"><br>
                <h2 style="color: white;">Enter your name</h2>
                <input type="text" id="player-name" name="player-name"><br>
                <input type="submit" id="submit-roomnum" name="submit-roomnum" >
            </form>
        </center>
    </body>
</html>