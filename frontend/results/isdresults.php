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

    <header> <h1> Results for Student <?php echo isset($_POST['eid']) ? $_POST['eid'] : "Test User?";?> </h1></header>
    <div>

    <?php
    $debug = 1; // Enables the debug boxes
    $testdata = 0; //Enables the use of live data

    $eid = ((isset($_POST['eid']))) ? $_POST['eid'] : 39;
    $sid = ((isset($_POST['sid']))) ? $_POST['sid'] : 39;

    if (!$testdata) {
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'s_results', 'eid'=> $eid, 'sid' => $sid)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);

        $results = json_decode($return_val, true);

        if ($debug) {
            echo "<h2> POST INPUT </h2>";
            echo "<div class='debug'>";
            if ($_POST != null) {
                print_r($_POST);
                echo "as well as the identifier s_results";
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
            //Check to see if we're actually getting variables here.
            if ($return_val == null) {
                echo "<h2> ERROR: ANSWERS COULD NOT BE RETRIEVED, USING TEST DATA </h2>";
                $testdata = rand(10, 50); //We didn't? Whatever, then make testdata.
            }
        }
    }

    if ($testdata) { //Generate our own joke data
        $results = array();
        for ($i=0; $i<$testdata; $i++){
            //Generate some nonsense
            $max = rand(5, 39);
            $score = rand(0, $max);
            $text=rand(100000, 99999999);
            $answer = rand(100000, 99999999);

            $tests = array();
            $outputs = array();
            $sols = array();
            $tcr = rand(1, 5);
            for ($k=0; $k<$tcr; $k++){
                array_push($tests, "( ". rand(100000, 99999999) ."," . rand(100000, 99999999) . "," . rand(100000, 99999999) .")");
                array_push($sols, rand(1, 10));
                array_push($outputs, rand(1, 10));

            }

            $result = array(
                'maxscore' => $max,
                'score' => $score,
                'Question' => $text,
                'Answer' => $answer,
                'testcase' => $tests,
                'solution' => $sols,
                'output' => $outputs
            );
            array_push($results, $result);
        }
    }


    ?>

    <table>

    <tr> <th> Question </th> <th> Answer </th> <th> Testcase Results </th> <th> Comment </th> </tr>

    <?php
    foreach($results as $question){
        // First lets get our variables sorted out
        $maxscore = ((isset($question['maxscore']))) ? $question['maxscore'] : "39";
        $score = ((isset($question['score']))) ? $question['score'] : "39";
        $qtext = ((isset($question['Question']))) ? $question['Question'] : "How could this happen?!?!?";
        $answer = ((isset($question['Answer']))) ? $question['Answer'] : "print('there's a bug?')";

        $testcases = ((isset($question['testcase']))) ? $question['testcase'] : array("I didn't", "read this", "correctly");
        $solutions = ((isset($question['solution']))) ? $question['solution'] : array("This didn't", "happen like", "I expected");
        $output = ((isset($question['output']))) ? $question['output'] : array("Fix", "This", "Bug");

        $tcnum = sizeof($testcases);

        //Okily Dokily, now lets figure out this logic
        echo "<tr><form>"; // Each row is going to be its own form
        echo '<td> '.$qtext.' </td>';
        echo '<td> '.$answer.'</td>';

        //TESTCASE: This is where it gets good
        echo '<td><table>'; //Scared yet?
        echo '<tr> <th> TESTCASE </th> <th> RESULT </th> <th> SOLUTION </th> </tr>';
        for ($i=0; $i<$tcnum; $i++){
            echo '<tr>';
            echo '<td> Testcase '. $i .': '. $testcases[$i] .'</td>';
            echo '<td>' . $output[$i] . '</td>';
            echo '<td>'. $solutions[$i] . '</td>';
            echo '</tr>';
        }
        echo '</table>'; //Actually that wasn't that bad... he says unaware of the behemoth he has released

        // SCORE and EDIT DIALOG
        echo '<td> SCORE: '.$score."/".$maxscore."<br>";
        echo 'Edit <input type=number max='.$maxscore.' min=0> Comment <textarea> </textarea>';
        echo '</td>';
        echo "</form></tr>";
    }
    ?>
</table>
</body>
</html>
