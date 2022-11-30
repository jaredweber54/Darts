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
        <input type="checkbox" name="check_list[]" value="Jerry"><label>Jerry</label><br/>
        <input type="checkbox" name="check_list[]" value="Trev"><label>Trev</label><br/>
        <input type="checkbox" name="check_list[]" value="Mas"><label>Mas</label><br/>
        <input type="checkbox" name="check_list[]" value="Benni"><label>Benni</label><br/>
        <input type="checkbox" name="check_list[]" value="Swags"><label>Swags</label><br/>
        <br>
        <input type="submit" name="start" class="btn" value="Start Game">
        </form>
    </body>

  
     <?php
        session_start();
        $db_name = "DARTS";              // Database: DARTS
        $db_user = "jaredweber54";       // User: jaredweber54
        $db_passwd = "web2022";  
        $db = new mysqli("localhost", $db_user, $db_passwd, $db_name);


        if(isset($_POST['start'])){
            $array = array("first");
           if(!empty($_POST['check_list'])){
                // Loop to store and display values of individual checked checkbox.
                 foreach($_POST['check_list'] as $selected){
                     array_push($array, $selected);
             }
            } 
            array_shift($array);    //gets rid of the "first" element
            shuffle($array);        //reorders the array for random order
            
            $get_looser = "SELECT LOOSER FROM GAME ORDER BY DATE LIMIT 1";
            $db_looser = $db->query($get_looser) or die ("failed");
            $looser = mysqli_fetch_array($db_looser);           //gets looser of last game
            array_push($array, $looser[0]);
            $_SESSION['order'] = $array;
            header("Location: gameHome.php");
            
        }
     

    ?> 
</html>