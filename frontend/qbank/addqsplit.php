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

    $debug = 0;
    $debug = 1;
    if (!isset($_POST['id']) or $_POST['id'] == null or $_POST['identifier'] == "r_testbank") {
        echo "<h1> Add New Question </h1>";

        //We just removed a quesiton, however we also may have had text in the fields.    Lets take a look

        /*$purpose = "a_testbank"; //Just because we tapped remove, doesn' mean we weren't just editing a question;
        $qtext = "";
        $diff =  "Easy";
        $soln = array("", "");
        $testcases = array("", "");
        */

        //ternary operator
        //$var = <conditional>                   ? <yescase>          : <nocase>;
        $purpose = (isset($_POST['identifier']))     ? $_POST['identifier'] : "a_testbank";
        $qtext = (isset($_POST['question']))     ? $_POST['question'] : "";
        $diff = (isset($_POST['difficulty']))    ? $_POST['difficulty'] : "Easy";
        $soln = (isset($_POST['solution']))      ? $_POST['solution'] : array("","");
        $testcases = (isset($_POST['testcase']) and $_POST['testcase'] != null) ? $_POST['testcase'] : array("","");
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

        echo "<h1> Modify Question </h1>";
        $purpose = "e_question";

        //Okay so this question will come as multiple questions so we will need to be ready for that
        $question = json_decode($return_val, true);
        $tcs = array();
        $sols = array();
        foreach ($question as $row){
            array_push($tcs, $row['TestCase']);
            array_push($sols, $row['Answer']);
        }
        //Now that we've done that, we can just pick a question out of the stack
        $question=$question[0];
        $qtext = $question['Question'];
        $diff =  $question['Difficulty'];
        $soln = $sols;
        $testcases = $tcs;
    }

    //Check to see if the number of testcases is set
    if (isset($_POST['numtc'])) {
        //It is, set it to that
        $numtc = $_POST['numtc'];
    }
    else {//It's not, create a new variable
        //This will differ depending on if we're working on a new question or modifying an existing one
        if ($purpose == "e_question") {
            // We're editing a question, set the number of testcases equsl to the amount it already has
            $numtc = sizeof($question['TestCase']);
        }
        else{ // We're creating a new one. Start out with just 2.
            $numtc = 2;
        }
    }

    if ($debug) {
        echo "<h3> POST INPUT </h3>";
        echo "<div style='background-color:#EEEEEE;box-shadow: 0px 0px 0px;max-width:95%;margin:auto;'>";
        print_r($_POST);
        echo "</div>";
        echo '<br>';
        echo "<h3> JSON OUTPUT </h3>";
        echo "<div style='background-color:#EEEEEE;box-shadow: 0px 0px 0px;max-width:95%;margin:auto;'>".$return_val."</div>";
        echo '<br>';
    }

    echo '<form action="../loopers/qblooper.php" method="post">';
    echo '<div class="form">';
    echo '<form action="../debug.php" method="post">';
    foreach (array("Easy", "Medium", "Hard") as $rdiff){
        echo '<input type="radio" name=difficulty value="' . $rdiff . '"';
        if ($rdiff==$diff) { echo "checked";
        }
        echo '> ' . $rdiff;
    }
        echo "<br>";
        echo '<label for="question"> Question Text:</question> <br>';
        echo '<textarea name="question">' . $qtext .' </textarea><br> <br>';

    for ($i = 0; $i<sizeof($testcases) || $i<$numtc; $i++){
        echo 'Test Case '. ($i + 1) .' : <input type="text" name="testcase[' . $i .']" value="'. $testcases[$i] . '">';
        echo 'Solution '. ($i + 1) .' :<input type="text" name="solution[' . $i . ']" value="'. $soln[$i] . '"><br>';
    }
    if ($purpose == "e_question") {
        echo '<input type = "hidden" name="qid" value='. $_POST['id']. '>';
    }
    echo '<input type="hidden" name="numtc" value="'. $numtc .'">';
    echo '<input type="hidden" name="subidentifier" value="'.$purpose.'">'; //We still want posts to remember what they were doing right?
    echo '<button type="submit" name="identifier" value="a_tc"> Add another Testcase </button>';
    echo '<button type="submit" name="identifier" value="'.$purpose.'"> Submit Question </button>';
    echo "</form>";
    echo "</div>";
    ?>
</div>
    <div class="testbankquestions">
    <h1>Test Bank Questions</h1>
        <?php
        if (isset($_POST['tbfilter']) and $_POST['tbfilter'] != null) {
                $tbfilter=$_POST['tbfilter'];
        }
        else{
                $tbfilter="none";
        }
        if (isset($_POST['id'])) {
                $Qid=$_POST['id'];
        }
        else{
            $Qid=0;
        }

        echo '<form action="addqsplit.php" method="post" id="filter">';
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
        if ($return_val == null) {
            echo "<h2> No questions are available at this time!</h2>";
            exit;
        }
        $questions = json_decode($return_val, true);

            echo '<table style="width:100%">';
            echo '<tr><th> Question </th> <th> Difficulty </th> <th> Edit </th> <th> Delete</th< </tr>';
        foreach ($questions as $question){
            // Check to see if this question matches the filter
            if ($tbfilter != 'none' and $tbfilter != $question['Difficulty']) {
                continue; //Break on any question that doesn't match the filter.
            }

            // Check to see if this question is the one we're currently modifying
            if ($question['Qid'] == $Qid) {echo '<tr style="background-color:cyan;">';
            }
            else{ echo '<tr>';
            }

            //echo '<form method="post" action="addqsplit.php">';
            echo '<form method="post" action="../loopers/qblooper.php">';
            echo '<input type="hidden" name="id" value="'. $question['Qid'] . '">';
            echo '<input type="hidden" name="tbfilter" value="'.$tbfilter.'">';

            echo '<td>'. $question['Question'] . '</td>';
            echo '<td> ' . $question['Difficulty'] . '</td>';
            echo '<td> <button type="submit" name ="identifier" value="doesntmatter"> Edit</button>  </td>';
            echo '<td> <button type="submit" name ="identifier" value="r_testbank"> Remove</button>  </td>';
            echo '</form>';
            echo '</tr>';
        }
        echo "</table>"
        ?>
    </div>
</body>
</html>
