
 <?php

session_start();
$db_name = "DARTS"; // Database: CS344F22PW
$db_user = "jaredweber54";       // User: CS344F22
$db_passwd = "web2022";     // Password: CS344F22
$db = new mysqli("localhost", $db_user, $db_passwd, $db_name); //creates connection to database



$text = $_POST['text1'];
$btn1 = $_POST['btn1'];
$btn2 = $_POST['btn2'];
$game_id = $_SESSION['game_id'];
$int_id = (int)$game_id;
$cur_player = $_SESSION['current_player'];
$round = $_SESSION['round'];
$scoresArr = $_SESSION['scoresArr'];
$t = "date";
$score = (int)$text;
array_push($scoresArr, $score);
$_SESSION['scoresArr'] = $scoresArr;


if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
} else {
 if(count($scoresArr) == 8){
    $total_score = 0;
    foreach($scoresArr as $i){
        $total_score = $i + $total_score;
    }
    echo($scoresArr[7]);
    $sql_get_player = "SELECT PLAYER_ID FROM PLAYER WHERE PLAYER_NAME = '$cur_player'";
    $db_player = $db->query($sql_get_player) or die("Failed");
    $player_id = mysqli_fetch_array($db_player);
    echo($player_id[0]);

    $sql_insert = "INSERT INTO ROUNDS (PLAYER_ID, GAME_ID, ROUND, THROW_1, THROW_2, THROW_3,
    THROW_4, THROW_5, THROW_6, THROW_7, TOTAL_SCORE)
    VALUES ($player_id[0],$game_id,$round,$scoresArr[1],$scoresArr[2],
    $scoresArr[3],$scoresArr[4],$scoresArr[5],$scoresArr[6],$scoresArr[7],$total_score)";
    //  VALUES (1, $int_id, $round, $scoresArr[1],$scoresArr[2],$scoresArr[3],
    //  $scoresArr[4],$scoresArr[5],$scoresArr[6],$scoresArr[7], $total_score])";
    $db->query($sql_insert) or die('Sorry, database operation was failed');

 }
}









// $sql_get_player = "SELECT PLAYER_ID FROM PLAYER WHERE PLAYER_NAME = '$cur_player'";
// $db_player = $db->query($sql_get_player) or die("Failed");
// $player_id = mysqli_fetch_array($db_player);
//     $sql_insert = "INSERT INTO ROUNDS (PLAYER_ID, GAME_ID,ROUND, THROW_1)
//      VALUES ($player_id[0], $game_id, $round, $int)";
//     $db->query($sql_insert) or die('Sorry, database operation was failed');
// // $sql_insert = "UPDATE ROUNDS SET THROW_2 = $int
// //                WHERE PLAYER_ID = $player_id[0] AND GAME_ID = 1";
// //     $db->query($sql_insert) or die('Sorry, database operation was failed');



 $db->close();
?>  




