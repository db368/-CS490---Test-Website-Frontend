<html>

<head>
    <title> Student Landing Page </title>
    <link rel="stylesheet" href="styles.css">
</head>

<header> <h1> Welcome </h1> </header>
<body>

    <?php

    $debug = 1;
    if ($debug) {
        echo '<div class="debug">';
        echo "<h3> POST ARRAY</h3>";
        var_dump($_POST);

        echo "</div>";
    }
         $username = (isset($_POST['username'])) ? $_POST['username'] : "Test User";
         $sid = (isset($_POST['sid'])) ? $_POST['sid'] : 39;echo '<div class="login">';
         echo "<h1> Welcome ".$username."!</h1>";
         //echo "<h1> ID ".$sid."!</h1>";
         echo "<form method=post action=debug.php>";
         echo '<input type="hidden" name="username" value="'.$username.'"><br>';
         echo '<input type="hidden" name="sid" value="'.$sid.'"><br>';

         //echo '<a class="click-me" href="exams/vexams.php">View Exams</a><br>';
         //echo '<a class="click-me" href="ui.php"> Logout </a> <br>';
         echo "<div class=form>";
         echo '<button type="submit" formaction="exams/vexams.php"> View Exams </button><br>';
         echo '<button type="submit" formaction="results/sresults.php"> View results </button><br>';
         echo '<button type="submit" formaction="ui.html"> Logout </button><br>';
         echo "</div>";
         echo "</div>";
    ?>
</body>

</html>
