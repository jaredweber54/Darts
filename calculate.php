
 <?php

session_start();
$db_name = "DARTS"; // Database: CS344F22PW
$db_user = "jaredweber54";       // User: CS344F22
$db_passwd = "web2022";     // Password: CS344F22
$db = new mysqli("localhost", $db_user, $db_passwd, $db_name); //creates connection to database



$text = $_POST['text1'];
$score = (int)$text;
$game_id = $_SESSION['game_id'];
$cur_player = $_SESSION['current_player'];
$orderArr = $_SESSION['order'];
$round = $_SESSION['round'];
$scoresArr = $_SESSION['scoresArr'];
$winnerArr = array("first");
array_shift($winnerArr);
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
    $sql_get_player = "SELECT PLAYER_ID FROM PLAYER WHERE PLAYER_NAME = '$cur_player'";
    $db_player = $db->query($sql_get_player) or die("Failed");
    $player_id = mysqli_fetch_array($db_player);

    $sql_insert = "INSERT INTO ROUNDS (PLAYER_ID, GAME_ID, ROUND, THROW_1, THROW_2, THROW_3,
    THROW_4, THROW_5, THROW_6, THROW_7, TOTAL_SCORE)
    VALUES ($player_id[0],$game_id,$round,$scoresArr[1],$scoresArr[2],
    $scoresArr[3],$scoresArr[4],$scoresArr[5],$scoresArr[6],$scoresArr[7],$total_score)";
    $db->query($sql_insert) or die('Sorry, database operation was failed');
    array_shift($orderArr);

    if(empty($orderArr)){
        $sql_get_scores = 
        "SELECT PLAYER_ID, TOTAL_SCORE FROM ROUNDS 
        WHERE GAME_ID = $game_id AND ROUND = $round
        ORDER BY TOTAL_SCORE DESC;";
        $db_get_scores = $db->query($sql_get_scores) or die("Failed");
        // $get_scores = mysqli_fetch_array($db_get_scores);
        $compArr = array("first" => "response");
        array_shift($compArr);       
        while($resultArr = mysqli_fetch_array($db_get_scores, MYSQLI_ASSOC)) { //fetch the query result (w/ results from query) by row and print
            $compArr += [$resultArr['PLAYER_ID'] => $resultArr['TOTAL_SCORE']];
        }
        print_r($compArr);
        $firstKey = array_key_first($compArr);
        array_push($winnerArr, $firstKey);
        $b = false;
        $orderArr = array("first");
        array_shift($orderArr);
        foreach ($compArr as $key => $value){
            if(!$b){
                $b = true;
                continue;
            }
            $sql_get_name = "SELECT PLAYER_NAME FROM PLAYER WHERE PLAYER_ID = '$key'";
            $db_name = $db->query($sql_get_name) or die("Failed");
            $player_name = mysqli_fetch_array($db_name);
                array_push($orderArr, $player_name[0]);
        }
        $orderArr = array_reverse($orderArr);
    }
    $_SESSION['current_player'] = $orderArr[0];
    $_SESSION['order'] = $orderArr;
    $scoresArr = array("Scores: ");
    $_SESSION['scoresArr'] = $scoresArr;
    $_SESSION['round'] = $round + 1;

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




