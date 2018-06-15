<html>
<style>
.inline {
    display: inline;
}

.link-button {
    background: none;
    border: none;
    color: black;
    text-decoration: underline;
    cursor: pointer;
    font-size: 1em;
    font-family: serif;
}

.link-button:focus {
    outline: none;
}

.link-button:active {
    color: red;
}
</style>
<head>
    <title> Results </title>
    <link rel="stylesheet" href="../styles.css">

</head>
<body>

    <header> <h1> Results for <?php echo $_POST['exname'];  ?> </h1></header>
    <div class=login>

    <?php
    $debug = 1;
    $eid = ((isset($_POST['eid']))) ? $_POST['eid'] : 39;

    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, "$target");
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'results', 'eid'=> $eid)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);

    $results = json_decode($return_val, true);

    if ($debug) {
        echo "<h2> POST INPUT </h2>";
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
        if ($return_val != null) {
            echo $return_val;
        }
        else{
            echo "No return value!";
        }
        echo "</div>";
        echo '<br>';
    }

    //Check to see if we're actually getting variables here.
    if ($return_val == null) {
        echo "<h2> ERROR: EXAM LIST COULD NOT BE RETRIEVED </h2>";
        exit;
    }
    ?>

    <table>
    <tr> <th> STUDENT </th> <th> AVERAGE </th> </tr>

    <?php
    foreach($results as $student){
        echo "<tr>";
        $sid = ((isset($student['Student_id']))) ? $student['Student_id'] : "39";
        $score = ((isset($student['sum(score)']))) ? $student['sum(score)'] : "39";
        //echo '<form method="post" action="../debug.php">';
        echo '<form method="post" action="isdresults.php">'; //Details page
        echo '<input type="hidden" name="sid" value="'.$sid.'">';
        echo '<input type="hidden" name="exid" value="'.$eid.'">';
        echo '<td> <button type="submit" class="link-button" name="sid" value="'.$sid.'"> '.$sid.' </button> </td>';
        echo '<td>'. $score . '</td>';
        echo "</form></tr>";
    }
    ?>
</table>
</body>
</html>
