<html>
<head>
    <title> Exam Question Add </title>
<style>

div.testbankquestions {
    float: right;
    overflow: auto;
    width: 50%;
    background-color: cyan;
    height:75%;
}
div.examquestions {
    float: left;
    overflow: auto;
    width: 50%;
    background-color: pink;
    height:75%;
}
th, td{
    border:1px solid;
    padding: 8px;
}

tr:nth-child(even){
    background-color:#FFFFFF;
    padding: 16px;
}

</style>
</head>
<body>
    <div class="examquestions">
    <?php
        //This will eventually be replaced with a curl post to the database for all exam names
        $examquestions = array(); //Time to pupulate this with dumb stuff
        $examids = array();
        $diffs = array();
        $tas = 100; //Test Array Size
        $scores = array();

    for($i=0; $i<$tas; $i++){
        array_push($examquestions, 'Exam '. rand(1000, 9999));
        array_push($examids, $i);
        $r = rand(0, 2);
        switch ($r){
        case 1:
            array_push($diffs, "Easy");
            break;
        case 2:
            array_push($diffs, "Medium");
            break;
        case 3:
            array_push($diffs, "Hard");
            break;
        default:
                array_push($diffs, "UV"); //Dig the prowess!
        }
        array_push($scores, rand(1, 20));
    }
    echo '<table style="width:100%">';
    echo '<form method="post" action="http://afsaccess3.njit.edu/~db368/CS490/debug/debug.php">';
    echo '<tr> <th> Remove </th> <th> Question </th> <th> Difficulty </th> <th> Score </th> </tr>';
    for ($i=0; $i<$tas; $i++){
        $cid = array_pop($examids); // This is the only variable used twice
        echo '<tr>';
        echo '<td> <input type="checkbox" name="qid" value="'. $cid . '"> </td>';
        echo '<td>'. array_pop($examquestions) . '</td>';
        echo '<td> ' . array_pop($diffs) . '</td>';
        echo '<td> <input type="number" name="score" value="'. array_pop($scores) . '"></td>';
        echo '</tr>';
    }
    echo "</table>";
    //TODO: Make the submit button actually float
?>
    <input type="submit" name="submit" value="Submit Changes">
</div>
    </form>

    <div class="testbankquestions">
        How does this look?
    </div>
</body>
</html>
