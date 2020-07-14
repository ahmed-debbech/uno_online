<?php
include_once("card.php");
class Shuffler{
    function __construct(){

    }
    public function organizeCards($roomCode){
        include("../../keys.php");
        //connect and to get all players in the room
        $link = mysqli_connect($serverIp, $username, $pass, $dbName);
        if (!$link) {
            die('<strong>You were not able to connect to your database because ' . mysqli_error() . '</strong>');
        }
        $sql = "select * from player where roomCode='".$roomCode."'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($link);

        //for each player do this
        foreach($row as $arr){
            for($y=0; $y<=6; $y++){
                //retrieve the number of the next card in the stack from stack table
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "select * from stack where roomCode='".$roomCode."'";
                $result1 = mysqli_query($link, $sql);
                $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                mysqli_close($link);

                //change the next card number attribute in stack table to the next number and update the remaining cards number
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $d = $row1["nextCardNumber"] + 1;
                $f = $row1["numberOfCardsRemaining"] - 1;
                $sql = "update stack set nextCardNumber=".$d.", numberOfCardsRemaining=".$f." where roomCode='".$roomCode."'"; 
                $res1 = mysqli_query($link,$sql); 
                mysqli_close($link);
                
                //update each card with the id of the player who gets it
                $link = mysqli_connect($serverIp, $username, $pass, $dbName);
                $sql = "update card set id='".$arr["id"]."' where stack_id='".$roomCode."' and order_in_stack='".$row1["nextCardNumber"]."'"; 
                $res2 = mysqli_query($link,$sql); 
                mysqli_close($link);
            }
        }
    }
    public function createStack($stack){
        include_once("../../phpconnect.php");
        $sql="insert into stack (stack_id, numberOfCardsRemaining, roomCode, nextCardNumber) values (:id, :nocr, :rc, :ncn)";
        $db = Connector::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':id',$stack->getId());
            $req->bindValue(':nocr',$stack->getNOCR());
            $req->bindValue(':rc',$stack->getRoomCode());
            $req->bindValue(':ncn',$stack->getNCN());
            $yo = $req->execute();
        }
        catch (Exception $e){
            echo 'Error: '.$e->getMessage();
        }
    }
    private function checkOrder($order, $array, $limit){
        for($i=0; $i<$limit; $i++){
            if($array[$i]->getOrderInStack() == $order){
                return false;
            }
        }
        return true;
    }
    private function store($array){
        include_once("../../phpconnect.php");
        /*for($i=0; $i<=count($array)-1; $i++){
            echo $array[$i]->getContent()."|".$array[$i]->getOrderInStack()." ";
        }*/
        for($i=0; $i<=107; $i++){
            $sql="insert into card (stack_id, number, order_in_stack, content, id) values (:stack_id, :number, :order_in_stack, :content, :id)";
            $db = Connector::getConnexion();
            try{
                $req=$db->prepare($sql);
                $req->bindValue(':stack_id',$array[$i]->getStackId());
                $req->bindValue(':number',$array[$i]->getNumber());
                $req->bindValue(':order_in_stack',$array[$i]->getOrderInStack());
                $req->bindValue(':content',$array[$i]->getContent());
                $req->bindValue(':id', $array[$i]->getPlayerId());
                /*echo $array[$i]->getStackId();
                echo $array[$i]->getNumber();
                echo "|";
                echo $array[$i]->getOrderInStack();
                echo "|";
                echo $array[$i]->getContent();
                echo $array[$i]->getPlayerId();
                echo "<br>";*/
                $yo = $req->execute();
            }
            catch (Exception $e){
                echo 'Error: '.$e->getMessage();
            }
        }
    }
    public function shuffleCards($stack){
        $arr = array();
        $content = "";
        $order = 0;
        $number = 0;
        for($i=0; $i<=9; $i++){
            $content = $i."-r";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order, $content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-y";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-g";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-b";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-r";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-y";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-g";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-b";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        //other than number cards 
        $color = "r";
        for($i=0; $i<=7; $i++){
            $content = "blo-".$color;
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
            $content = "inv-".$color;
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
            $content = "+2-".$color;
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
            if($color == "r") $color="y"; else
            if($color == "y") $color="g"; else
            if($color == "g") $color = "b"; else
            if($color == "b") $color = "r";
        }
        //wild cards
        for($i=0; $i<=7; $i++){
            if($i<=3){
                $content = "wc";
            }else{
                $content = "+4";
            }
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, NULL);
            array_push($arr, $card);
            $number++;
        }
        $this->store($arr);
    }
}
?>