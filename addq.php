<html>
<style>
.inline {
    display: inline;
}

.link-button {
    background: none;
    border: none;
    color: blue;
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
    <title> Modify/Add Question </title>
</head>

<body>
    <h1> Modify Question </h1>
<?php
    //Obtain Question from Database
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, "$target");
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question','questionid'=>$_POST['questionid'])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);
if ($return_val == null) {
    echo "<h1> ERROR: NO RETURN VALUE </h1>";
    exit;
}
    //Begin Table
    /* Debug Code.
    $qtext = "Question Text";
    $testcases= array("Testcase 1", "Testcase 2", "Testcase 3");
    $solutions = array("Solution 1", "Solution 2", "Solution 3");
    $almagamation = array_combine($testcases, $solutions);
    $diff = "Easy";
    $purpose = "a_testbank";*/

$question = json_decode($return_val, true);

$qtext = $question['Question'];
$diff = $question['Difficulty'];
$testcases = $question['Testcases'];

echo '<form action="qblooper.php" method="post">';
foreach (array("Easy", "Medium", "Hard") as $rdiff){
    echo '<input type="radio" name=difficulty value="' . $rdiff . '"';
    if ($rdiff==$diff) { echo "checked";
    }
    echo '> ' . $rdiff;
}
    echo "<br>";
    echo 'Question Text: ';
    echo '<input type="text" name="question" value="'. $qtext . '"><br> <br>';
    $i = 1;
foreach ($testcase as $case){ // Solutions aren't supported by the DB yet.
    echo 'Test Case '. $i .' : <input type="text" name="testcase[' . $i .']" value="'. $case . '"><br>';
    //echo 'Solution '. $i .' :<input type="text" name="solution[' . $i . ']" value="'. $sol . '"><br>';
    $i++;
}
    echo '<input type="hidden" name="identifier" value="'. $purpose . '">';
    echo '<button type="submit" class="link-button"> Submit </button>';
    echo "</form>";
?>
    <a href='qbank.php'> Cancel </a>
</body>
</html>
