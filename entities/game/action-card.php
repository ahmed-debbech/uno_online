<?php
include_once("card-handler.php");

class ActionCard extends CardHandler{
    private function startsWith2 ($string, $startString){ 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 
    public function whichOne(){
        if($this->startsWith2($this->cardContent, "+2") === true){
            return "+2";
        }else{
            if($this->startsWith2($this->cardContent, "+4") === true){
                return "+4";
            }else{
                if($this->startsWith2($this->cardContent, "blo") === true){
                    return "blo";
                }else{
                    if($this->startsWith2($this->cardContent, "inv") === true){
                        return "inv";
                    }
                }
            }
        }
        return false;
    }
    private function plusTwo(){
        include("../../keys.php");
        //get two cards from the stack to the next player
        //get stack data
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from stack where stack_id='".$this->roomCode."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);
        //get next player id
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);
        $d = $row["numberOfCardsRemaining"];
        $g = $row["nextCardNumber"];
        for($i=0; $i<2; $i++){
            //assign a card from stack to affected player
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "update card set id='".$row1["nextPlayer"]."' where order_in_stack=".$g." and stack_id='".$this->roomCode."'"; 
            mysqli_query($link,$sql); 
            mysqli_close($link);
            //decrement the number of cards in stack
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $d--;
            $g++;
            $sql = "update stack set numberOfCardsRemaining=".$d.", nextCardNumber=".$g." where stack_id='".$this->roomCode."'"; 
            mysqli_query($link,$sql); 
            mysqli_close($link);
        }
    }
    private function plusFour(){
        include("../../keys.php");
        //get two cards from the stack to the next player
        //get stack data
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from stack where stack_id='".$this->roomCode."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);
        //get next player id
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);
        $d = $row["numberOfCardsRemaining"];
        $g = $row["nextCardNumber"];
        for($i=0; $i<4; $i++){
            //assign a card from stack to affected player
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "update card set id='".$row1["nextPlayer"]."' where order_in_stack=".$g." and stack_id='".$this->roomCode."'"; 
            mysqli_query($link,$sql); 
            mysqli_close($link);
            //decrement the number of cards in stack
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $d--;
            $g++;
            $sql = "update stack set numberOfCardsRemaining=".$d.", nextCardNumber=".$g." where stack_id='".$this->roomCode."'"; 
            mysqli_query($link,$sql); 
            mysqli_close($link);
        }
    }
    private function block(){
        include("../../keys.php");
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$row["nextPlayer"]."'";
        $res = mysqli_query($link,$sql); 
        $final = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "update room set playerTurn='".$final["nextPlayer"]."' where roomCode='".$this->roomCode."'"; 
        $res1 = mysqli_query($link,$sql); 
        mysqli_close($link);
    }
    private function inverse(){
        include("../../keys.php");
        //get the direction flag
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from room where roomCode='".$this->roomCode."'";
        $res = mysqli_query($link,$sql); 
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        $sql = "select * from player where id='".$this->playerId."'";
        $res = mysqli_query($link,$sql); 
        $row1 = mysqli_fetch_array($res, MYSQLI_ASSOC);
        mysqli_close($link);

        $numofplr = 4 - $row["numberOfPlayersRemaining"];
        if($numofplr != 2){
            if($row["direction"] == 1){
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "update room set direction=0 where roomCode='".$this->roomCode."'"; 
                $res1 = mysqli_query($link,$sql); 
                mysqli_close($link);

                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "update room set playerTurn='".$row1["previousPlayer"]."' where roomCode='".$this->roomCode."'"; 
                $res1 = mysqli_query($link,$sql); 
                mysqli_close($link);
            }else{
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "update room set direction=1 where roomCode='".$this->roomCode."'"; 
                $res1 = mysqli_query($link,$sql); 
                mysqli_close($link);

                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "update room set playerTurn='".$row1["nextPlayer"]."' where roomCode='".$this->roomCode."'"; 
                $res1 = mysqli_query($link,$sql); 
                mysqli_close($link);
            }
        }else{
            /*
            * if the number of players is only two then play inverse card as block card to the second player
            */
            $link = mysqli_connect($serverIp, $username, $pass, $dbName);
            $sql = "update room set playerTurn='".$this->playerId."' where roomCode='".$this->roomCode."'"; 
            $res1 = mysqli_query($link,$sql); 
            mysqli_close($link);
        }
    }
    public function applyActionCard(){
        if($this->whichOne() == "+2"){
            $this->plusTwo();
        }else{
            if($this->whichOne() == "+4"){
                $this->plusFour();
            }else{
                if($this->whichOne() == "blo"){
                    $this->block();
                }else{
                    if($this->whichOne() == "inv"){
                        $this->inverse();
                    }
                }
            }
        }
    }
}
?>