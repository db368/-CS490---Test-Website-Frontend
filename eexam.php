<html>
<head>
    <title> Exam Question Add </title>
<style>

div.testbankquestions {
    float: right;
    overflow: auto;
    width: 50%;
    background-color: lightgreen;
    height:75%;
}
div.examquestions {
    float: left;
    overflow: auto;
    width: 50%;
    background-color: lightblue;
    height:75%;
}
th, td{
    border:1px solid;
    padding: 8px;
}

tr:nth-child(even){
    background-color:lightblue;
    padding: 16px;
}

</style>
</head>
<body>
    <div class="examquestions">
    <h1> Exam Questions </h1>
    <?php
        //This will eventually be replaced with a curl post to the database for all exam names
        $examquestions = array(); //Time to pupulate this with test stuff
        $examids = array(); //These are actually question ids
        $diffs = array();
        $tas = 100; //Test Array Size
        $scores = array();

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
    echo '<table style="width:100%">';
    echo '<tr><th> Question </th> <th> Difficulty </th> <th> Score </th> <th> Update </th><th> Remove </th> </tr>';
    for ($i=0; $i<$tas; $i++){
        echo '<form method="post" action="debug.php">';
        $cid = array_pop($examids); // This is the only variable used twice
        echo '<tr>';
        echo '<input type="hidden" name="qid" value="'. $cid . '">';
        echo '<td>'. array_pop($examquestions) . '</td>';
        echo '<td> ' . array_pop($diffs) . '</td>';
        echo '<td> <input type="number" name="score" value="'. array_pop($scores) . '"></td>';
        echo '<td> <input type="submit" name="identifier" value="aq_exam">  </td>';
        echo '<td> <input type="submit" name="identifier" value="req_exam"> </td>';
        echo '</form>';
        echo '</tr>';
    }
    echo "</table>";
    //TODO: Make the submit button actually float
?>
    <!--<input type="submit" name="submit" value="Submit Changes"> Maybe turn this on again later-->
</div>
    <div class="testbankquestions">
    <h1>Test Bank Questions</h1>
        <?php
            $examids = array(); //Ids in the exam bank
            $qbids = array();
            $questionbank = array(); //Questions in the question bank
            $testcases=array();
            $diffs = array();
            $tas = 100; //Test Array Size
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
            echo '<table style="width:100%">';
            echo '<tr><th> Question </th> <th> Difficulty </th> <th> Testcases </th> <th> Add to Exam </th> </tr>';
        for ($i=0; $i<count($qbids); $i++){
            echo '<form method="post" action="debug.php">';
            /*if (in_array($qbids[$i], $examids)) { //This question is already on the array, skip it
                continue;
            }*/
            echo '<tr>';
            echo '<form method="post" action="debug.php">';
            echo '<input type="hidden" name="qid" value="'. $qbids[$i] . '">';
            echo '<td>'. $questionbank[$i] . '</td>';
            echo '<td> ' . $diffs[$i] . '</td>';
            echo '<td>'. count($testcases[$i]). '</td>';
            echo '<td> <input type="submit" name="identifier" value="aq_exam">  </td>';
            echo '</form>';
            echo '</tr>';
        }
        echo "</table>"
        ?>
    </div>
</body>
</html>
