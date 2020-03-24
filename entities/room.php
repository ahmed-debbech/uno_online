<?php
include ("player.php");
class Room {
    private $roomCode;
    private $arrayOfPlayers;
    function __construct($code, $initialPlayer){
        $this->roomCode = $code;
        $arrayOfPlayers = array();
        array_push($arrayOfPlayers, $initialPlayer);
    }
    public function getRoomCode(){
        return $this->roomCode;
    }
    public function getPlayers(){
        return $this->arrayOfPlayers;
    }   
    public function addPlayer($theplayer){
        array_push($arrayOfPlayers, $theplayer);
    }
}
?>