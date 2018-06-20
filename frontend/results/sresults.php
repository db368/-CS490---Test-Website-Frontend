<html>
<style>
.inline {
    display: inline;
}
</style>
<head>
    <title> EXAM Results </title>
    <link rel="stylesheet" href="../styles.css">

</head>
<body>
    <header> <h1> Results By Exam </h1> </header>
    <p> Click on an exam to recieve your grade and a detailed breakdown. </p>
    <div class=login>
    <?php
    $debug = 1;
        //First, we get a list of exams

    $sid = $_POST['sid'];
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_exams')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
    if ($return_val == null) {
        echo "<h3> ERROR: EXAM LIST COULD NOT BE RETRIEVED </h3>";
        exit;
    }
    $exams = json_decode($return_val, true);
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
    //var_dump($exams);
    echo "<table>";
    echo "<tr> <th> EXAM </th> </tr>"; //Only need to do a single form I think
    foreach($exams as $exam){
        $exid = "error"; $exname = "error";
        if (isset($exam['Eid'])) { $exid = $exam['Eid'];
        }
        if (isset($exam['Name'])) { $exname = $exam['Name'];
        }
        if (!$exam['Release_ready']) { //THis exam isn't released, skip it
            continue;
        }
        //echo '<form method="post" action="../debug.php">';
        echo '<form method="post" action="sdresults.php">';
        echo '<input type="hidden" name="eid" value="'.$exid.'">';
        echo '<input type="hidden" name="sid" value="'.$sid.'">';
        echo '<td> <button type="submit" class="link-button" name="identifier" value="results"> '.$exname.' </button> </td>';
        echo "</form></tr>";
    }
    echo "</table>";

    ?>

</body>
</html>
