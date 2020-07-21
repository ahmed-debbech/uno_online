<?php
class CardHandler{
    private $roomCode;
    private $playerId;
    private $cardContent;
    private $color;

    function __construct($room, $player, $card){
        $this->roomCode = $room;
        $this->playerId = $player;
        $this->cardContent = $card;
    }   
    function setColor($color){
        $this->color = $color;
    }
}
?>