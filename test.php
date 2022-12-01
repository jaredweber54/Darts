<?php
// Report all error information on the webpage
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$array = $_SESSION['order'];
$current_player = $_SESSION['current_player'];
$scoresArr = $_SESSION['scoresArr'];
echo("Order: ");
foreach($array as $i){
    echo($i . " -- ");
}
echo( " | " .  $current_player);
echo("<br>");
foreach($scoresArr as $i){
    echo($i . " -- ");
}

?>