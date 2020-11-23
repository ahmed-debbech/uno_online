<?php
class CardHandler{
    protected $roomCode;
    protected $playerId;
    protected $cardContent;
    protected $color;
    protected $cardNum;

    function __construct($room, $player, $card, $num){
        $this->roomCode = $room;
        $this->playerId = $player;
        $this->cardContent = $card;
        $this->cardNum = $num;
        $this->color = "none";
    }   
    public function setColor($color){
        $this->color = $color;
    }
    public function isCompatible(){
        include("../../keys.php");
        if($this->cardContent == "+4" || $this->cardContent == "wc"){
            return true;
        }

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from room where roomCode='".$this->roomCode."'";
        $res = mysqli_query($link,$sql); 
        $list = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        if($list["cardOnTable"] == "+4" || $list["cardOnTable"] == "wc"){
            if($list["color"] == $this->cardContent[strlen($this->cardContent)-1] || $list["color"] == NULL){
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
                    $buff2 .= $list["cardOnTable"][$i];
                    $i++;
                }while($list["cardOnTable"][$i]!= "-");
                if($buff == $buff2){
                    return true;
                }
            }
        }
        return false;
    }
    public function updateCardOnTable(){
        include("../../keys.php");
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        if($this->color == "none"){
            $sql = "update room set cardOnTable='".$this->cardContent."' , color='".$this->cardContent[strlen($this->cardContent)-1]."' where roomCode='".$this->roomCode."'";
        }else{
            $sql = "update room set cardOnTable='".$this->cardContent."', color='".$this->color."' where roomCode='".$this->roomCode."'"; 
        }
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);
    }
    public function managePlayerCards(){
        include("../../keys.php");
        //get the number of remaining cards in hand of the player 
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        //decrement the number of cards in hand
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $num = $row["numCards"]-1;
        $sql = "update player set numCards=".$num." where id='".$this->playerId."' roomCode='".$this->roomCode."'"; 
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);

        //remove of the card assignment to the player 
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "update card set id=NULL where number=".$this->cardNum." and stack_id='".$this->roomCode."'"; 
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);
    }
    public function passTurn(){
        include("../../keys.php");
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from room where roomCode='".$this->roomCode."'";
        $res = mysqli_query($link,$sql); 
        $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        if($row1["direction"] == 1){
            $sql = "update room set playerTurn='".$row["nextPlayer"]."' where roomCode='".$this->roomCode."'"; 
        }else{
            $sql = "update room set playerTurn='".$row["previousPlayer"]."' where roomCode='".$this->roomCode."'"; 
        }
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);
    }
    public function isActionCard(){
        function startsWith ($string, $startString){ 
            $len = strlen($startString); 
            return (substr($string, 0, $len) === $startString); 
        } 
        if(startsWith($this->cardContent, "+2") === true){
            return true;
        }else{
            if(startsWith($this->cardContent, "+4") === true){
                return true;
            }else{
                if(startsWith($this->cardContent, "blo") === true){
                    return true;
                }else{
                    if(startsWith($this->cardContent, "inv") === true){
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
?>