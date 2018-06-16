<html>

<head>
    <title> Exam Submitted</title>
    <link rel="stylesheet" href="../styles.css">

</title>

<body>
<?php
    $debug = 1;
    echo "<div class='login'>";
    $exid=($_POST['exid']);
    //Send answers to the server
    $target = 'https://web.njit.edu/~jll25/CS490/switch.php';
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);
    if ($debug) {
      echo "<h1> POST INPUT </h1>";
      echo "<div class='debug'>";
    if ($_POST != null) {
        print_r($_POST);
    }
    else{ echo "No Post!";
    }
        echo "</div>";
        echo '<br>';
        echo "<h2> JSON OUTPUT </h2>";
        echo "<div class='debug'>";
        echo $return_val;
        echo "</div>";
}

?>
    <h2> The exam is now finished </h2>
    <a href="vexams.php">  Click here to return to the exam dialog </a>
    </div>
</body>

</html>
