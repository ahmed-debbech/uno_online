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
            if($list["color"] == $this->cardContent[strlen($this->cardContent)-1]){
                return true;
            }
        }else{
            if($list["color"] == $this->cardContent[strlen($this->cardContent)-1]){
                return true;
            }else{
                $i=0; $buff = "";
                do{ 
                    $buff .= $this->cardContent[$i];
                    $i++;
                }while($this->cardContent[$i] != "-");
                $i=0; $buff2 = "";

                do{ 
                    $buff .= $list["cardOnTable"][$i];
                    $i++;
                }while($list["cardOnTable"][$i]!= "-");
                if($buff == $buff2){
                    return true;
                }
            }
        }
        return false;
    }
}
?>