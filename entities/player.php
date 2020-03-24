<?php
class Player {
    private $id;
    private $name;
    public function __construct($name,$id){
     $this->id = $id;
     $this->name = $name;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
}
?>