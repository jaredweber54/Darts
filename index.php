
<!DOCTYPE html>
<html>
    <head>
        <title>Starting Lineup</title>
        <meta name="author" value="daniel palmer">
        <meta name="dateCreated" value="10/31/22">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Who's Playing?</h1>
        <form method="POST">
        <div class = checkbox>
        <label for="checkbox2" class="checkdiv">
        <input type="checkbox" class = "check"name="check_list[]" value="JERRY"><label>JERRY</label><br/>
        <input type="checkbox"class = "check" name="check_list[]" value="TREV"><label>TREV</label><br/>
        <input type="checkbox"class = "check" name="check_list[]" value="MAS"><label>MAS</label><br/>
        <input type="checkbox"class = "check" name="check_list[]" value="BENNI"><label>BENNI</label><br/>
        <input type="checkbox"class = "check" name="check_list[]" value="SWAGS"><label>SWAGS</label><br/>
        </label>
        </div>
        <br>
        <input type="submit" name="start" class="btn" value="Start Game">
        </form>
    </body>
    <style>
        
    </style>

  
     <?php
        session_start();
        $db_name = "DARTS";              // Database: DARTS
        $db_user = "jaredweber54";       // User: jaredweber54
        $db_passwd = "web2022";  
        $db = new mysqli("localhost", $db_user, $db_passwd, $db_name);


        if(isset($_POST['start'])){
            $array = array("first");
            $get_looser = "SELECT LOOSER FROM GAME ORDER BY DATE DESC LIMIT 1"; //UPDATE HERE
            $db_looser = $db->query($get_looser) or die ("failed");
            $looser = mysqli_fetch_array($db_looser);           //gets looser of last game
            $get_looser_name = "SELECT PLAYER_NAME FROM PLAYER WHERE PLAYER_ID = $looser[0];"; //UPDATE HERE
            $db_looser_name = $db->query($get_looser_name) or die ("failed");
            $looser_name = mysqli_fetch_array($db_looser_name);
            $flag = false;
           if(!empty($_POST['check_list'])){
                // Loop to store and display values of individual checked checkbox.
                 foreach($_POST['check_list'] as $selected){
                    if($selected == $looser_name[0]){
                        $flag = true;
                        continue;
                    } else {
                     array_push($array, $selected);
                    }
            } 
        }
            array_shift($array);    //gets rid of the "first" element
            shuffle($array);        //reorders the array for random order
            if($flag){
                array_push($array, $looser_name[0]);
            }
           
            
            
          
            
            $sql_insert = "INSERT INTO GAME (LOOSER) VALUES (1)"; //UPDATE HERE
            $db->query($sql_insert) or die('Sorry, database operation was failed');
            $_SESSION['order'] = $array;
            $_SESSION['current_player'] = $array[0];
            $get_game_id = "SELECT GAME_ID FROM GAME ORDER BY DATE DESC LIMIT 1"; //UPDATE HERE
            $db_game_id = $db->query($get_game_id) or die ("failed");
            $game_id = mysqli_fetch_array($db_game_id);
            $_SESSION['game_id'] = $game_id[0];
            $_SESSION['round'] = 1;
            $scoresArr = array("Scores: ");
            array_shift($scoresArr);
            $_SESSION['scoresArr'] = $scoresArr;
            $total_Score = 0;
            $_SESSION['total_score'] = $total_score;
            $high = 0;
            $dist_from_high = 0;
            $_SESSION['high'] = $high = 0;
            $_SESSION['dist_from_high'] = $dist_from_high;
            $dist_six = 0;
            $_SESSION['dist_six'] = $dist_six;
            $winnerArr = array(1);
            array_shift($winnerArr);
            $_SESSION['winner'] = $winnerArr;

              header("Location: home.html");
            
            
        }
     
        $db->close();
    ?> 
</html>
