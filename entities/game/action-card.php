<?php
include_once("card-handler.php");

class ActionCard extends CardHandler{
    public function whichOne(){
        function startsWith2 ($string, $startString){ 
            $len = strlen($startString); 
            return (substr($string, 0, $len) === $startString); 
        } 
        if(startsWith2($this->cardContent, "+2") === true){
            return "+2";
        }else{
            if(startsWith2($this->cardContent, "+4") === true){
                return "+4";
            }else{
                if(startsWith2($this->cardContent, "blo") === true){
                    return "blo";
                }else{
                    if(startsWith2($this->cardContent, "inv") === true){
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
        echo "pluss";
    }
    private function plusFour(){

    }
    private function block(){

    }
    private function inverse(){

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