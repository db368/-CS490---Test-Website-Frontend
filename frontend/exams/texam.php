<html>
<head>
    <title> Taking Exam </title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<?php
    $debug = 1;

    $questions = $_POST['questions'];
    $number = $_POST['currentquestion'];
    $exid = $_POST['exid'];

    if (isset($_POST['answers'])) {
        $answer = $_POST['answers'];
    }
    else {
        $answer = array();
    }
    echo "<header><h1> EXAM </h1> </header>";
    $qid = $questions[$number];
    if($debug){
        echo "<div class=debug>";
        echo "<h1> Incoming POST </h1>";
        echo var_dump($_POST);

        echo "<h1> Incoming questions </h1>";
        echo var_dump($questions);
        echo "<br> Current Question Number is ". $number. " anid the id is ". $qid . "<br>";
        echo "</div>";
    }

      //CURL to get the actual useful question information;
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question', 'questionid' => $qid)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);

    $question=json_decode($return_val, true)[0];
    $qtext = $question["Question"];

    //Start actually printing the file
    echo "<div class=login>";
    echo "<h1> QUESTION ".$number.": </h1>";
    echo "<p>" . $qtext . "</p><br>";

    //Now we get to do the fun work of posting it again
    echo '<form method="post" action="texam.php">';
    $i=0;
    foreach($questions as $q){
        echo '<input type=hidden name=questions['.$i.'] value="'.$questions[$i].'">';
        echo '<input type=hidden name=answer['.$i.'] value="'.$answer[$i].'">';
        $i=$i+1;
    }

        echo '<input type=textbox name=answer['.$number.'] value='. $answer[$number] .'><br>';
        echo '<input type=hidden name=exid value="'.$exid.'">';
    if ($number < count($questions)-1) {
        echo '<button type=submit name=currentquestion value='.($number+1).'> Next Question </button>';
    }
    if ($number != 1) {
        echo '<button type=submit name=currentquestion value='.($number-1).'> Previous Question </button>';
    }
        echo "</form>";
    // Submit button stuff
        //echo '<form method="post" action="examlandingpage.php">';
    echo '<form method="post" action="../debug.php">';
    $i=0;
    foreach($questions as $q){
        echo '<input type=hidden name=questions['.$i.'] value="'.$questions[$i].'">';
        echo '<input type=hidden name=answer['.$i.'] value="'.$answer[$i].'">';
        $i=$i+1;
    }
    echo '<input type=hidden name=exid value="'.$exid.'">';
    echo '<button type=submit name=identifier value=answer> Submit answer </button>';
    echo '</form>';
    echo "</div>";
?>


</body>
