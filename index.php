<!DOCTYPE html>
<html>
    <head>
        <title>Login Portal</title>
        <meta name="author" value="daniel palmer">
        <meta name="dateCreated" value="10/31/22">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h1>Welcome!</h1>
        <form method="POST">
            <input type="submit" name="start" class="btn" value="Start Game">
        </form>
    </body>

     <?php
    
     if(isset($_POST['start'])){
         header("Location: gameHome.php");
     }

    ?> 
</html>