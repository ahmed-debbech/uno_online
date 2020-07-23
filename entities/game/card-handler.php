<?php
class CardHandler{
    private $roomCode;
    private $playerId;
    private $cardContent;
    private $color;

    function __construct($room, $player, $card){
        $this->roomCode = $room;
        $this->playerId = $player;
        $this->cardContent = $card;
        $this->color = "none";
    }   
    public function setColor($color){
        $this->color = $color;
    }
    public function isCompatible($roomCode){
        include("../../keys.php");
        if($this->cardContent == "+4" || $this->cardContent == "wc"){
            return true;
        }

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from room where roomCode='".$roomCode."'";
        $res = mysqli_query($link,$sql); 
        $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        if($list["cardOnTable"] == "+4" || $list["cardOnTable"] == "wc"){
            echo "ff";
            if($list["color"] == $this->cardContent[strlen($this->cardContent)-1]){
                echo "wild";
            }
        }
        echo "none";
    }
}
?>