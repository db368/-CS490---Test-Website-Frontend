<html>

<head>
    <title> Student Landing Page </title>
    <link rel="stylesheet" href="styles.css">
</head>

<header> <h1> Welcome </h1> </header>
<body>
     <div class="debug">
    <?php
        $debug = 0;
    if ($debug) { //If debug is specified, dump this post
        echo "<h3> POST ARRAY</h3>";
        var_dump($_POST);
    }
         $username = (isset($_POST['username'])) ? $_POST['username'] : "Oh no";
    echo "</div>";
         echo '<div class="login">';
         echo "<h1> Welcome ".$username."!</h1>";
         echo "options";
         echo "<form method=post action=debug.php>";
         echo '<input type="hidden" name="username" value="'.$username.'"><br>';

         //echo '<a class="click-me" href="exams/vexams.php">View Exams</a><br>';
         //echo '<a class="click-me" href="ui.php"> Logout </a> <br>';
         echo "<div class=form>";
         echo '<button type="submit" formaction="exams/mexam.php"> Manage Exams </button><br>';
         echo '<button type="submit" formaction="results/iresults.php"> Manage Question Bank </button><br>';
         echo '<button type="submit" formaction="results/iresults.php"> View/Release Results </button><br>';
         echo '<button type="submit" formaction="ui.html"> Logout </button><br>';
         echo "</div>";
         echo "</div>";
    ?>
</body>

</html>
