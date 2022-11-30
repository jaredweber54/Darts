<!DOCTYPE html>
<html>
    <head>
        <title>Login Portal</title>
        <meta name="author" value="daniel palmer">
        <meta name="dateCreated" value="10/31/22">
        <link rel="stylesheet" href="styles.css">
        <script src="calculate.js"></script>
    </head>
    <body>
    <input type="text" id="txt" name="text" class="text">
    <button class="btn1" id="btn1" onclick="calc();"> </button>
    </body>

     <?php

    session_start();
    $arr = $_SESSION['order'];
    echo("<br>" ."Order:" . "<br>");
    foreach($arr as $i){
        echo($i . "<br>");
    }
    ?> 
    
    <p id = "scores"> </p>
    <br>
    <p id = "total_score"> </p>

    <?php


    ?>
</html>