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
    <title> Add a Question </title>
</head>

<body>
    <h1> Add A question! </h1>
<?php
    //Will need a lot of issets.
    $qtext = "Question Text";
    $testcases= array("Testcase 1", "Testcase 2", "Testcase 3");
    $solutions = array("Solution 1", "Solution 2", "Solution 3");
    $almagamation = array_combine($testcases, $solutions);
    $diff = "Easy";
    $purpose = "a_testbank";
    echo '<form action="debug.php" method="post">';
    foreach (array("Easy", "Medium", "Hard") as $rdiff){
        echo '<input type="radio" name=difficulty value="' . $rdiff . '"';
        if ($rdiff==$diff){ echo "checked";}
        echo '> ' . $rdiff;
    }
    echo "<br>";
    echo 'Question Text: ';
    echo '<input type="text" name="question" value="'. $qtext . '"><br> <br>';
    $i = 1;
    foreach ($almagamation as $case => $sol){
        echo 'Test Case '. $i .' : <input type="text" name="testcase[' . $i .']" value="'. $case . '">';
        echo 'Solution '. $i .' :<input type="text" name="solution[' . $i . ']" value="'. $sol . '"><br>';
    $i++;
    }
    echo '<input type="hidden" name="identifier" value="'. $purpose . '">';
    echo '<button type="submit" class="link-button"> Submit </button>';
    echo "</form>";
?>
    <a href='qbank.php'> Cancel </a>
</body>
</html>
