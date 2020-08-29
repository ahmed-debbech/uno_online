<?php
session_start();
include_once("../../../keys.php");

    function sort_for_dir($list){ 
        $ap = array();
        for($i=0; $i<count($list); $i++){
            if($_SESSION["player_id"] == $list[$i]["id"]){
                array_push($ap, $list[$i]);
            }
        }
        for($i=0; $i<count($list); $i++){
            for($j=0; $j<count($list); $j++){
                if($ap[$i]["nextPlayer"] == $list[$j]["id"]){
                    if($ap[0]["id"] != $list[$j]["id"]){
                        array_push($ap, $list[$j]);
                    }
                }
            }
        }
        return $ap;
    } 
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from player where roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_close($link);

    $ap = array();
    $ap = sort_for_dir($list);

    function getColor($id){
    include("../../../keys.php");
    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    $sql = "select * from room where roomCode='".$_GET["room-code"]."'";
    $res = mysqli_query($link,$sql); 
    $list = mysqli_fetch_all($res, MYSQLI_ASSOC);
    mysqli_close($link);
    if($id == $list[0]["playerTurn"]){
        return "red";
    }else{
        return "black";
    }
    }
   $res = "<tr>";
    foreach($ap as $row){
        if($row["id"] != $_SESSION["player_id"]){
            $res = $res . "<td>"
            ."<p style='color: ".getColor($row["id"]).";'>".$row["name"]." - Cards: ".$row["numCards"]."</p>"
            ."</td>";
        }
    }
    $res .= "</tr>";
    echo $res;
?>