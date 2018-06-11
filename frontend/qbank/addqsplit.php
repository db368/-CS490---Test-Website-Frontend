<html>
<head>
    <title> Question Bank/Add </title>
    <link rel="stylesheet" href="../styles.css">
<style>

div.testbankquestions {
    float: right;
    overflow: auto;
    height:100%;
    width:50%
}
div.editquestions {
    float: left;
    overflow: auto;
    width:49%;
    padding-bottom:10px;
}



</style>
</head>
<body>
    <div class="editquestions">
    <?php

    $debug = 0; //Use this to control hidden div
    $debug = 1;
    if (!isset($_POST['id']) or $_POST['id'] == null) {
        echo "<h1> Add New Question </h1>";
        $purpose = "a_testbank";

        $qtext = "";
        $diff =  "Easy";
        $soln = array("", "", "", "");
        $testcases = array("", "", "", "");
    }
    else {
        //Obtain Question from Database
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question','questionid'=>$_POST['id'])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
	
	if (!$return_val){
		echo "No question at value: ". $_POST['id'] .'?<br>';
		echo "And the post is set: ". isset($_POST['id']) .'?<br>';
		exit;
	}
        echo "<h1> Modify Question </h1>";
        echo $return_val;
	 $purpose = "e_question";

        $question = json_decode($return_val, true)[0];
        $qtext = $question['Question'];
        $diff =  $question['Difficulty'];
        $soln = $question['Answer'];
        $testcases = $question['TestCase'];

    }
        //Begin Table
        /* Debug Code.
        $qtext = "Question Text";
        $testcases= array("Testcase 1", "Testcase 2", "Testcase 3");
        $solutions = array("Solution 1", "Solution 2", "Solution 3");
        $almagamation = array_combine($testcases, $solutions);
        $diff = "Easy";
        $purpose = "a_testbank";*/


    //echo '<form action="../loopers/qblooper.php" method="post">';
    echo '<div class="form">';
    echo '<form action="../debug.php" method="post">';
    foreach (array("Easy", "Medium", "Hard") as $rdiff){
        echo '<input type="radio" name=difficulty value="' . $rdiff . '"';
        if ($rdiff==$diff) { echo "checked";
        }
        echo '> ' . $rdiff;
    }
        echo "<br>";
        echo 'Question Text: ';
        echo '<input type="text" name="question" value="'. $qtext . '"><br> <br>';

    for ($i = 0; $i<sizeof($testcases) || $i<4; $i++){ // Solutions aren't supported by the DB yet.
        echo 'Test Case '. ($i + 1) .' : <input type="text" name="testcase[' . $i .']" value="'. $testcases[$i] . '">';
        echo 'Solution '. ($i + 1) .' :<input type="text" name="solution[' . $i . ']" value="'. $soln[$i] . '"><br>';
    }
    if ($purpose == "e_question") {
        echo '<input type = "hidden" name="qid" value='. $_POST['id']. '>';
    }
    echo '<input type="hidden" name="identifier" value="'. $purpose .'">';
        echo '<button type="submit" class="link-button"> Submit </button>';
        echo "</form>";
    echo "</div>";


    /*
    //Check if the post is set
    if (!isset($_POST['id'])) {
        echo "No ID!??!";
        exit;
    }
    else {$Eid = $_POST["id"];
    }
    if (isset($_POST['filter'])) {
        $filter=$_POST['filter'];
    }
    else{
        $filter='none';
    }

    //Before we even curl, lets define this filter box
    echo '<form action="eexam.php" method="post" id="filter">';
    echo '<input type=hidden name=id value="'.$Eid.'">';
    echo '<input type="submit" value="Apply Filter">';
    echo '<select name="filter">';
    echo '<option value="none"> None </option>';
    echo '<option value="Easy"> Easy </option>';
    echo '<option value="Medium"> Medium </option>';
    echo '<option value="Hard"> Hard </option>';
    echo '</select>';
    echo '</form>';

    //Now you curl
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
    else{
        echo '<table style="width:100%">';
        echo '<tr><th> Question </th> <th> Difficulty </th> <th> Score </th> <th> Update </th><th> Remove </th> </tr>';
        foreach ($questions as $question){
            //Filter Logic
            if ($filter != 'none' and $filter != $question['Difficulty']) {
                continue; //Break on any question that doesn't match the filter.
            }
            echo '<form method="post" action="../debug.php">';
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
    */
    ?>
    <!-- <input type="submit" name="submit" value="Submit Changes"> Maybe turn this on again later -->
</div>
    <div class="testbankquestions">
    <h1>Test Bank Questions</h1>
        <?php
        if (isset($_POST['tbfilter'])) {
                $tbfilter=$_POST['tbfilter'];
        }
        if (isset($_POST['id'])) {
                $Qid=$_POST['id'];
        }
        else{
            $Qid=0;
        }

        //Before we even curl, lets define this filter box
        echo '<form action="eexam.php" method="post" id="filter">';
        echo '<input type="submit" value="Apply Filter">';
        echo '<select name="tbfilter">';
        echo '<option value="none"> None </option>';
        echo '<option value="Easy"> Easy </option>';
        echo '<option value="Medium"> Medium </option>';
        echo '<option value="Hard"> Hard </option>';
        echo '</select>';
        echo '</form>';

        //Obtain Question Bank
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $target);
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('identifier'=>'v_testbank'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
        if ($return_val == null){
            echo "<h2> No questions are available at this time!</h2>";
            exit;
        }
        $questions = json_decode($return_val, true);

            echo '<table style="width:100%">';
            // FOR RELEASE: echo '<tr><th> Question </th> <th> Difficulty </th> <th> Testcases </th> <th> Add to Exam </th> </tr>';
            echo '<tr><th> Question </th> <th> Difficulty </th> <th> Edit </th> </tr>';
        foreach ($questions as $question){
            //if (in_array($qbids[$i], $examids)) {  //TODO:This question is already on the array, skip it
            //   continue;
            //}
            if (($tbfilter != 'none' and $tbfilter != $question['Difficulty']) and ($Qid != null and  $question['id'] == $Qid))
             {
                continue; //Break on any question that doesn't match the filter.
            }

            echo '<tr>';
            echo '<form method="post" action="addqsplit.php">';
            //echo '<form method="post" action="../debug.php">';
            echo '<input type="hidden" name="id" value="'. $question['Qid'] . '">';

            echo '<td>'. $question['Question'] . '</td>';
            echo '<td> ' . $question['Difficulty'] . '</td>';
            echo '<td> <button type="submit" name ="identifier" value="aq_exam"> Edit</button>  </td>';
            echo '</form>';
            echo '</tr>';
        }
        echo "</table>"
        ?>
    </div>
</body>
</html>
