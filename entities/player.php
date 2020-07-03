<?php
include_once("../phpconnect.php");
class Player {
    private $id;
    private $name;
    private $numCards;
    private $roomAssigned; //"-1r" if none
    public function __construct($name,$id,$room){
     $this->id = $id;
     $this->name = $name;
     $this->roomAssigned = $room;
     $this->numCards = 7;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getAssignedRoom(){
        return $this->roomAssigned;
    }
    public function setAssignedRoom($room){
        $this->roomAssigned = $room;
    }
    public function getNumCards(){
        return $this->numCards;
    }
    public function setNumCards($cards){
        $this->numCards = $cards;
    }
    public function addPlayerToDB(){
        $sql="insert into player (id,name,numCards,roomCode) values (:id,:name,:numCards,:roomCode);";
        $db = Connector::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':id',$this->id);
            $req->bindValue(':name',$this->name);
            $req->bindValue(':numCards',$this->numCards);
            $req->bindValue(':roomCode',$this->roomAssigned);
            echo $this->id . $this->name. $this->numCards. $this->roomAssigned;
            $yo = $req->execute();
            var_dump($yo);
        }
        catch (Exception $e){
            echo 'Error: '.$e->getMessage();
        }
    }
}
?>