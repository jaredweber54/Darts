<!DOCTYPE html>
<html>
    <head>
        <title>Login Portal</title>
        <meta name="author" value="daniel palmer">
        <meta name="dateCreated" value="10/31/22">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Halo!</h1>
        <form method="POST">
            <input type="text" name = "text">
            <input type="submit" name = "submit">
        </form>
    </body>

     <?php
     $array = array("Jared", "Benni", "Swags", "Trev");
     $order = rand(0,3);
     $i = 0;
     echo("Order" . "<br>");
     shuffle($array);
    while($i < count($array)){
     echo($array[$i] . "<br>");
     $i++;
    }
    echo("<br>");
    echo($array[0] . " is up!" . "<br>");
    $count = 0;
    $scores = array(6, 2, 3, 4, 5, 6, 7);
     if(isset($_POST['submit'])){
        $text = $_POST['text'];
        $int = (int)$text;
        $scores[$count] = $int;
        $i = 0;
        $count++;
        while($i < $count){
        echo($scores[$i] . " ");
        $i++;
        }
        
     }
    ?> 
</html>