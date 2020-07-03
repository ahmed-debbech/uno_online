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
        array_push($this->arrayOfPlayers, $initialPlayer);
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
        $sql="insert into room (roomCode,numberOfPlayersRemaining,isStarted) values (:roomCode,:numberOfPlayersRemaining,:isStarted)";
        $db = Connector::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':roomCode',$this->roomCode);
            $req->bindValue(':numberOfPlayersRemaining',$this->numberOfPlayersRemaining);
            $req->bindValue(':isStarted',$this->isStarted);
            $yo = $req->execute();
            var_dump($yo);
        }
        catch (Exception $e){
            echo 'Error: '.$e->getMessage();
        }
    }
    public function setStarted(){
        $this->isStarted = 1;
    }
    public function isStarted(){
        return $this->isStarted;
    }
}
?>