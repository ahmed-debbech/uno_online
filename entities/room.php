<?php
include ("player.php");
class Room {
    private $roomCode;
    private $arrayOfPlayers;
    private $numberOfPlayersRemaining;
    function __construct($code, $initialPlayer){
        $this->numberOfPlayersRemaining = 3;
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
    public function getRemaining(){
        return $this->numberOfPlayersRemaining;
    }
    public function decrementRemaining(){
        $this->numberOfPlayersRemaining--;
    }
}
?>