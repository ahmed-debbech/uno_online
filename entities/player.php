<?php
class Player {
    private $id;
    private $name;
    function __construct($name,$id){
     $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
}
?>