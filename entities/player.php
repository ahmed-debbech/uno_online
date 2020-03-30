<?php
class Player {
    private $id;
    private $name;
    private $roomAssigned; //"-1r" if none
    public function __construct($name,$id,$room){
     $this->id = $id;
     $this->name = $name;
     $this->roomAssigned = $room;
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
}
?>