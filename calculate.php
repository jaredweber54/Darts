
 <?php

session_start();

$text = $_POST['text1'];
$t = "date";
$int = (int)$text;
$cur_player = $_SESSION['current_player'];
$db_name = "DARTS"; // Database: CS344F22PW
$db_user = "jaredweber54";       // User: CS344F22
$db_passwd = "web2022";     // Password: CS344F22
$db = new mysqli("localhost", $db_user, $db_passwd, $db_name); //creates connection to database




if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
} else {
$sql_get_player = "SELECT PLAYER_ID FROM PLAYER WHERE PLAYER_NAME = '$cur_player'";
$db_player = $db->query($sql_get_player) or die("Failed");
$player_id = mysqli_fetch_array($db_player);
    $sql_insert = "INSERT INTO ROUNDS (PLAYER_ID, GAME_ID,ROUND, THROW_1)
     VALUES ($player_id[0], 1, 3, $int)";
    $db->query($sql_insert) or die('Sorry, database operation was failed');
// // $sql_insert = "UPDATE ROUNDS SET THROW_2 = $int
// //                WHERE PLAYER_ID = $player_id[0] AND GAME_ID = 1";
// //     $db->query($sql_insert) or die('Sorry, database operation was failed');
}


// $db->close();
?>  




