<?php
class Card{
    private $stack_id;
    private $number;
    private $order_in_stack;
    private $content;
    private $id; 
    function __construct($stack_id, $number, $order_in_stack, $content, $id){
        $this->stack_id = $stack_id;
        $this->number = $number;
        $this->$order_in_stack = $order_in_stack;
        $this->content = $content;
        $this->id = $id;
    }
    public function getOrderInStack(){
        return $this->order_in_stack;
    }
    public function getContent(){
        return $this->content;
    }
}
?>