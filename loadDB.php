
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db_name = "DARTS"; // Database: CS344F22PW
$db_user = "jaredweber54";       // User: CS344F22
$db_passwd = "web2022";     // Password: CS344F22
// $testUser = 1;

$db = new mysqli("localhost", $db_user, $db_passwd, $db_name); //creates connection to database

if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
} else {
//Think this idea needs to be reworked:
   //[DONE] Initially load the messages in the db when the page is loaded 
   //[DONE] utilize ajax to constantly call the database for changes from when the user was last on the site? Not sure how this would work
   //       select statement to get messages from the last 5 minutes
   //           this is fine, just need to change the final query and it should look better
   $player = $_SESSION['current_player'];
//    $sql_select = "SELECT * FROM
//                    (SELECT LOGIN.USER_ID,
//                     LOGIN.USER_NAME, 
//                     MSG.MESSAGE,
//                    MSG.msgDate 
//                    FROM LOGIN                                      
//                    LEFT JOIN MSG 
//                    ON MSG.USER_ID = LOGIN.USER_ID 
//                    ORDER BY msgDate DESC LIMIT 10) k
//                    ORDER BY msgDate; ";      //Updated query to order the messages from oldest to newest
//    $result = $db->query($sql_select) or die("failure");
//    while($resultArr = mysqli_fetch_array($result, MYSQLI_ASSOC)) { //fetch the query result (w/ results from query) by row and print
//        if($user_name == $resultArr['USER_NAME']){
           print_r("}" . $player . "{");
    //    }else {
    //   print_r("}<div class = 'left'>" . $resultArr['USER_NAME'] . ": " . $resultArr['MESSAGE'] . " {". $resultArr['msgDate'] . "</div>");
    //        }
    //    } 
}

?>
