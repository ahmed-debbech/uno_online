<?php
include_once ("player.php");
class Room {
    private $roomCode;
    private $arrayOfPlayers = array();
    private $numberOfPlayersRemaining;
    private $isStarted;
    function __construct($code, $initialPlayer){
        $this->isStarted = 0;
        $this->numberOfPlayersRemaining = 3;
        $this->roomCode = $code;
        array_push($arrayOfPlayers, $initialPlayer);
    }
    public function getRoomCode(){
        return $this->roomCode;
    }
    public function getPlayers(){
        return $this->arrayOfPlayers;
    }   
    public function addPlayer($theplayer){
        array_push($this->arrayOfPlayers, $theplayer);
    }
    public function getRemaining(){
        return $this->numberOfPlayersRemaining;
    }
    public function decrementRemaining(){
        $this->numberOfPlayersRemaining--;
    }
    public function addRoomToDB(){
        $fileName = "../avail-rooms/".$this->roomCode.".txt";
        shell_exec("chmod 777 ".$fileName);
        $file = fopen($fileName, "w");
        fwrite($file, serialize($this));
        fclose($file);
    }
    public function setStarted(){
        $this->isStarted = 1;
    }
    public function isStarted(){
        return $this->isStarted;
    }
}
?>