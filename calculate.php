
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
$total_score = $_SESSION['total_score'];
$scoresArr = $_SESSION['scoresArr'];
$winnerArr = $_SESSION['winner'];

$last = substr($text, -1);
$length = strlen($text);
if($last == "D"){
    if($length == 2){
        $score = (int)substr($text,0,1);
        $score = $score * 2;
    } else {
        $score = (int)substr($text,0,2);
        $score = $score * 2;
    }

} else if($last = "T"){
    if($length == 2){
        $score = (int)substr($text,0,1);
        $score = $score * 3;
    } else {
        $score = (int)substr($text,0,2);
        $score = $score * 3;
    }

} else if($last = "B"){
    $score = (int)substr($text,0,2);

} else if($last = "X"){
    $score = (int)substr($text,0,2);
} else{
    $score = (int)$text;
}


$total_score = $total_score + $score;
$_SESSION['total_score'] = $total_score;

array_push($scoresArr, $text);
$_SESSION['scoresArr'] = $scoresArr;


if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
} else {
    if(count($scoresArr) == 8){
        echo(count($scoresArr));
    $sql_get_player = "SELECT PLAYER_ID FROM PPLAYER WHERE PLAYER_NAME = '$cur_player'";//UPDATE HERE
    $db_player = $db->query($sql_get_player) or die("Failed");
    $player_id = mysqli_fetch_array($db_player);

    $sql_insert = "INSERT INTO PROUNDS (PLAYER_ID, GAME_ID, ROUND, THROW_1, THROW_2, THROW_3,
    THROW_4, THROW_5, THROW_6, THROW_7, TOTAL_SCORE)                                
     VALUES ($player_id[0],$game_id,$round,'$scoresArr[0]','$scoresArr[1]',
     '$scoresArr[2]','$scoresArr[3]','$scoresArr[4]','$scoresArr[5]','$scoresArr[6]',$total_score)";//UPDATE HERE
    // $sql_insert = "INSERT INTO PROUNDS (PLAYER_ID, GAME_ID, ROUND, THROW_1, THROW_2, THROW_3,
    //   THROW_4, THROW_5, THROW_6, THROW_7, TOTAL_SCORE)
    //   VALUES ($player_id[0],$game_id,$round,"1","2",
    //   "3","4","5","6","7",$total_score)";
    $_SESSION['total'] = $total_score;
    $db->query($sql_insert) or die('Sorry, database operation was failed: SCORES');
    array_shift($orderArr);

    if(empty($orderArr)){
        $count = 0;
        $high = 0;
        $_SESSION['high'] = $high;          //UPDATE HERE
        $sql_get_scores = 
        "SELECT PLAYER_ID, TOTAL_SCORE FROM PROUNDS  
        WHERE GAME_ID = $game_id AND ROUND = $round
        ORDER BY TOTAL_SCORE DESC;";
        $db_get_scores = $db->query($sql_get_scores) or die("Failed");
        // $get_scores = mysqli_fetch_array($db_get_scores);
        $compArr = array("first" => "response");
        array_shift($compArr);       
        while($resultArr = mysqli_fetch_array($db_get_scores, MYSQLI_ASSOC)) { //fetch the query result (w/ results from query) by row and print
            $compArr += [$resultArr['PLAYER_ID'] => $resultArr['TOTAL_SCORE']];
            $count++;
        }
        $firstKey = array_key_first($compArr);
        $firstInt = (int)$firstKey;
        array_push($winnerArr, $firstInt);
        $_SESSION['winner'] = $winnerArr;
        $b = false;
        $orderArr = array("first");
        array_shift($orderArr);
        foreach ($compArr as $key => $value){
            if(!$b){
                $b = true;
                continue;
            }
            if($value == 69 && $count > 3){
                echo($key);
                $sql_game_update = "UPDATE PGAME SET SIX_NINE = $key
                WHERE GAME_ID = $game_id;";
                 $db->query($sql_game_update) or die("Failed six nine");
                continue;
            }
            $sql_get_name = "SELECT PLAYER_NAME FROM PPLAYER WHERE PLAYER_ID = '$key'"; //UPDATE HERE
            $db_name = $db->query($sql_get_name) or die("Failed");
            $player_name = mysqli_fetch_array($db_name);
                array_push($orderArr, $player_name[0]);
        }
        if(count($orderArr) == 1){
            echo($orderArr[0] . " Lost!");
            $sql_get_player = "SELECT PLAYER_ID FROM PPLAYER WHERE PLAYER_NAME = '$orderArr[0]'";//UPDATE HERE
            $db_player = $db->query($sql_get_player) or die("Failed");
            $player_id = mysqli_fetch_array($db_player);//UPDATE HERE
            if($round == 2){
             $sql_game_update = "UPDATE PGAME SET ROUND_1 = $winnerArr[0], 
                                ROUND_2 = $winnerArr[1], LOOSER = $player_id[0]
                                WHERE GAME_ID = $game_id;";
            $db->query($sql_game_update) or die("Failed");
            } else if($round == 3){
                $sql_game_update = "UPDATE PGAME SET ROUND_1 = $winnerArr[0], 
                                ROUND_2 = $winnerArr[1], 
                                ROUND_3 = $winnerArr[2],
                                LOOSER = $player_id[0]
                                WHERE GAME_ID = $game_id;";
            $db->query($sql_game_update) or die("Failed");
            } else if($round == 4){
                $sql_game_update = "UPDATE PGAME SET ROUND_1 = $winnerArr[0], 
                                ROUND_2 = $winnerArr[1], 
                                ROUND_3 = $winnerArr[2],
                                ROUND_4 = $winnerArr[3],
                                LOOSER = $player_id[0]
                                WHERE GAME_ID = $game_id;";
            } else if($round == 5){
                $sql_game_update = "UPDATE PGAME SET ROUND_1 = $winnerArr[0], 
                ROUND_2 = $winnerArr[1], 
                ROUND_3 = $winnerArr[2],
                ROUND_4 = $winnerArr[3],
                ROUND_5 = $winnerArr[4],
                LOOSER = $player_id[0]
                WHERE GAME_ID = $game_id;";
                 $db->query($sql_game_update) or die("Failed");
            }

        }
        $orderArr = array_reverse($orderArr);
        $total_score = 0;
        $round++;
        $_SESSION['round'] = $round;

    }
    $total_score = 0;
    $_SESSION['total_score'] = $total_score;
    $_SESSION['current_player'] = $orderArr[0];
    $_SESSION['order'] = $orderArr;
    $scoresArr = array("Scores: ");
    array_shift($scoresArr);
    $_SESSION['scoresArr'] = $scoresArr;

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


