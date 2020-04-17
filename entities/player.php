<?php
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
}
?>