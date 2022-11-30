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
    <button class="btn1" id="btn1" onclick="calc();"> </button>
    <input type="text" name="text" class="text">

    </body>

     <?php

    session_start();
    $arr = $_SESSION['order'];
    echo("Order:" . "<br>");
    foreach($arr as $i){
        echo($i . "<br>");
    }
    ?> 
</html>