<?php
include_once("../keys.php");

    $link = mysqli_connect($serverIp, $username, $pass, $dbName);
    if (!$link) {
        die('<strong>You were not able to connect to your database because ' . mysqli_error() . '</strong>');
    }
    $sql = "select * from player where roomCode='".$_GET["room-code"]."'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $text="<tr>
    <th>Player ID</th>
    <th>Name</th>
  </tr>";
    foreach($row as $array){
        $text = $text . "<tr>"
        . "<td style='color: black;'>"
        . $array["id"]
        . "</td>"
        . "<td style='color: black;'>"
        . $array["name"]
        . "</td>"
        . "</tr>";
    }
    echo $text;
?>