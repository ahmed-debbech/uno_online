<?php
include_once ("player.php");
class Room {
    private $roomCode;
    private $numberOfPlayersRemaining;
    private $isStarted;
    private $isEnded;
    private $cardOnTable; // '-' means none
    function __construct($code, $initialPlayer, $cardOnTable){
        $this->isStarted = 0;
        $this->isEnded = 0;
        $this->numberOfPlayersRemaining = 3;
        $this->roomCode = $code;    
        $this->cardOnTable=$cardOnTable;
    }
    public function getRoomCode(){
        return $this->roomCode;
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
        include ("../phpconnect.php");
        $sql="insert into room (roomCode,numberOfPlayersRemaining,isStarted,cardOnTable,isEnded) values (:roomCode,:numberOfPlayersRemaining,:isStarted,:cot,:isEnded)";
        $db = Connector::getConnexion();
        try{
            $req=$db->prepare($sql);
            $req->bindValue(':roomCode',$this->roomCode);
            $req->bindValue(':numberOfPlayersRemaining',$this->numberOfPlayersRemaining);
            $req->bindValue(':isStarted',$this->isStarted);
            $req->bindValue(":cot", $this->cardOnTable);
            $req->bindValue(":isEnded", $this->isEnded);
            $yo = $req->execute();
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
    public function isEnded(){
        return $this->isEnded;
    }
    public function setEnded(){
        $this->isEnded = 1;
    }
}
?>