<?php
include_once("card-handler.php");

class ActionCard extends CardHandler{
    public function whichOne(){
        function startsWith2 ($string, $startString){ 
            $len = strlen($startString); 
            return (substr($string, 0, $len) === $startString); 
        } 
        if(startsWith2($this->cardContent, "+2") === true){
            return "+2";
        }else{
            if(startsWith2($this->cardContent, "+4") === true){
                return "+4";
            }else{
                if(startsWith2($this->cardContent, "blo") === true){
                    return "blo";
                }else{
                    if(startsWith2($this->cardContent, "inv") === true){
                        return "inv";
                    }
                }
            }
        }
        return false;
    }
    private function plusTwo(){

    }
    private function plusFour(){

    }
    private function block(){

    }
    private function inverse(){

    }
    public function applyActionCard(){
        if($this->whichOne() == "+2"){

        }else{
            if($this->whichOne() == "+4"){

            }else{
                if($this->whichOne() == "blo"){

                }else{
                    if($this->whichOne() == "inv"){

                    }
                }
            }
        }
    }
}
?>