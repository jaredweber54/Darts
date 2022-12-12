<?php
session_start();
$scoresArr = $_SESSION['scoresArr'];
$total_score = $_SESSION['total_score'];
$high = $_SESSION['high'];
if($high == $total_score){
    $total_score = $total_score - end($scoresArr);
    $high = $total_score;
    $_SESSION['high'] = $high;
} else {
    $total_score = $total_score - end($scoresArr);
}
array_pop($scoresArr);
$_SESSION['scoresArr'] = $scoresArr;
$_SESSION['total_score'] = $total_score;
?>  


