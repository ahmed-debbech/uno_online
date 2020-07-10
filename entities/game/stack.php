<?php
class Stack{
    private $id;
    private $nocr; // number of cards remaining
    private $roomCode;
    private $ncn; // next stack number
    function __construct($id, $nocr, $roomCode, $ncn){
        $this->id = $id;
        $this->nocr = $nocr;
        $this->roomCode = $roomCode;
        $this->ncn = $ncn;
    }
    public function getRoomCode(){return $this->roomCode;}
    public function getNOCR(){return $this->nocr;}
    public function getId(){return $this->id;}
    public function getNCN(){return $this->ncn;}
}
?>