<?php 
function plusfour(){
return <<<HTML
      <html>
      <head>
        <style>
          div.div_war9a_plus4{
              border: 5px solid #E5E7E9;
              border-radius: 20px;
              height: 120px;
              width: 80px;
              background-color: black;
              margin: auto;
            }
            div.icon_plus4{
              border: 5px solid red;
              border-radius: 50px;
              height: 50px;
              width: 50px;
            
                animation: mymove 2s infinite;
            } 
            @keyframes mymove {
              50% {box-shadow: 4px 8px 10px white;}
            }
            
            img.icon_plus4{
              height: 50px;
              width: 50px;
            }
        </style>
      </head>
      <body>
        <div onclick="setCont('+4'); this.parentNode.submit();" name="card" class="div_war9a_plus4">
          </br>
          <div class="icon_plus4">
            <center> <b class="war9a_plus4"><img src="assets/res/four_cards.png" class="icon_plus4"></b> 
            </center>
          </div>
          <img src="assets/res/logo.png" class="logo">
        </div>
      </body>

      </html>
  HTML;
}
?>