<html>
<head>
    <title> Exam Question Add </title>
<style>

div.testbankquestions {
    float: right;
    overflow: auto;
    width: 50%;
    background-color: orange;
    height:100%;
}
div.examquestions {
    float: left;
    overflow: auto;
    width: 50%;
    background-color: lightblue;
    height:100%;
}
th, td{
    border:1px solid;
    padding: 8px;
}

tr:nth-child(even){
    background-color:white;
    padding: 16px;
}
th{
    background-color: gray;
}


</style>
</head>
<body>
    <div class="examquestions">
    <h1> Exam Questions </h1>
    <?php
    if (!isset($_POST['id'])) {
        echo "No ID!??!";
        exit;
    }
    else {$Eid = $_POST["id"];
    }
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('identifier'=>'e_get_questions', 'id' => $_POST["id"]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);

    $questions = json_decode($return_val, true);
    if ($questions == null) {
        echo "No questions yet!";
    }
    //No more test code
    /*
    for($i=0; $i<$tas; $i++){
        array_push($examquestions, 'Question '. rand(1000, 9999));
        array_push($examids, $i);
        $r = rand(0, 2);
        switch ($r){
        case 0:
            array_push($diffs, "Easy");
            break;
        case 1:
            array_push($diffs, "Medium");
            break;
        case 2:
            array_push($diffs, "Hard");
            break;
        default:
                array_push($diffs, "UV"); //Dig the prowess!
        }
        array_push($scores, rand(1, 20));
    }
    */
    else{
        echo '<table style="width:100%">';
        echo '<tr><th> Question </th> <th> Difficulty </th> <th> Score </th> <th> Update </th><th> Remove </th> </tr>';
        foreach ($questions as $question){
            echo '<form method="post" action="../loopers/exlooper.php">';
            echo '<input type="hidden" name="eid" value="'. $Eid . '">';
            $qid = $question['Qid']; // This is the only variable used twice
            echo '<tr>';
            echo '<input type="hidden" name="qid" value="'. $cid . '">';
            echo '<td>'. $question['Question'] . '</td>';
            echo '<td> ' . $question['Difficulty'] . '</td>';
            echo '<td> <input type="number" name="score" value="'. $question['Total_points'] . '"></td>';
            echo '<td> <button type="submit" name ="identifier" value="aq_exam"> Update </button>  </td>';
            echo '<td> <button type="submit" name ="identifier" value="req_exam"> Remove </button></td>';
            echo '</form>';
            echo '</tr>';
        }

        echo "</table>";
    }
    //TODO: Make the submit button actually float
?>
    <!--<input type="submit" name="submit" value="Submit Changes"> Maybe turn this on again later-->
</div>
    <div class="testbankquestions">
    <h1>Test Bank Questions</h1>
        <?php
        $Eid = $_POST['id'];
        //Obtain Question Bank
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $target);
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('identifier'=>'v_testbank'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
        $questions = json_decode($return_val, true);

        /* Test Data
        for ($i = 0; $i<$tas; $i++)
        {
            array_push($examquestions, 'Question '. rand(1000, 9999));
            array_push($qbids, $i);
            //if (rand(0,20) > 15){
            if (false) {
                array_push($examids, $i);
            }
            array_push($examids, $i);
            array_push($questionbank, "Question ". $i);
            $numcases = rand(1, 5);
            $cases = array();
            for ($k=0; $k<$numcases; $k++){
                array_push($cases, 39);
            }
            array_push($testcases, $cases);
            array_push($diffs, "Difficulty");
        }
        */
            echo '<table style="width:100%">';
            // FOR RELEASE: echo '<tr><th> Question </th> <th> Difficulty </th> <th> Testcases </th> <th> Add to Exam </th> </tr>';
            echo '<tr><th> Question </th> <th> Difficulty </th> <th> Add to Exam </th> </tr>';
        foreach ($questions as $question){
            //if (in_array($qbids[$i], $examids)) {  //TODO:This question is already on the array, skip it
            //   continue;
            //}
            echo '<tr>';
            echo '<form method="post" action="../loopers/exlooper.php">';
            echo '<input type="hidden" name="qid" value="'. $question['Qid'] . '">';
            echo '<input type="hidden" name="eid" value="'. $Eid . '">';
            echo '<input type="hidden" name="score" value="0">';

            echo '<td>'. $question['Question'] . '</td>';
            echo '<td> ' . $question['Difficulty'] . '</td>';
            //echo '<td>'. count($testcases[$i]). '</td>';
            echo '<td> <button type="submit" name ="identifier" value="aq_exam"> Add to Exam </button>  </td>';
            echo '</form>';
            echo '</tr>';
        }
        echo "</table>"
        ?>
    </div>
</body>
</html>
