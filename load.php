<?php
// Report all error information on the webpage
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$array = $_SESSION['order'];
$current_player = $_SESSION['current_player'];
$scoresArr = $_SESSION['scoresArr'];
$total_score = $_SESSION['total_score'];
$dist_from_high = $_SESSION['dist_from_high'];
$winnerArr = $_SESSION['winner'];
$dist_six = $_SESSION['dist_six'];
$high = $_SESSION['high'];
echo("Order: ");
foreach($array as $i){
    echo($i . " -- ");
}
echo("<br>");
echo("Scores: ");
foreach($scoresArr as $i){
    echo($i . " -- ");
}
if($total_score > $high && $total_score != 0){
    $high = $total_score;
    $_SESSION['high'] = $high;   
} else{
    $dist_from_high = $high - $total_score;
    $_SESSION['dist_from_high'] = $dist_from_high;
}
echo("<br>");
echo("Total: " . $total_score);
echo("<br>");
echo("Distance from High Score: " . $dist_from_high );
echo("<br>");
echo("High: " . $high);
echo("<br>");
$dist_six = 69 - $total_score;
$_SESSION['dist_six'] = $dist_six;
echo("Distance from 69: " . $dist_six);



?>