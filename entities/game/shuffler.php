<?php
include_once("card.php");

class Shuffler{
    function __construct(){

    }
    private function organizeCards(){

    }
    public function createStack($stack){
        include ("../../phpconnect.php");
        $sql="insert into stack (stack_id, numberOfCardsRemaining, roomCode, nextCardNumber) values (:id, :nocr, :rc, :ncn)";
        $db = Connector::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':id',$stack->getNOCR());
            $req->bindValue(':nocr',$stack->getId());
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
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-y";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-g";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=9; $i++){
            $content = $i."-b";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-r";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-y";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-g";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=1; $i<=9; $i++){
            $content = $i."-b";
            do{
                $order = rand(1,108);
            }while($this->checkOrder($order, $arr, $number) == false);
            $card = new Card($stack->getId(), $number, $order,$content, "-");
            array_push($arr, $card);
            $number++;
        }
        for($i=0; $i<=count($arr)-1; $i++){
            echo $arr[$i]->getContent()."//".$arr[$i]->getOrderInStack();
        }
        echo "*******".count($arr);
    }
}
?>