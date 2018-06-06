<html>
<head>
    <title> Taking Exam </title>
</head>
<body>
<?php
    $questions = $_POST['questions'];
    $number = $_POST['currentnumber'];

    $qid = $questions[$number];
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question', 'questionid' => $_POST["id"])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);

    $question=json_decode($return_val);
    $qtext = $question["Question"];

    echo "<h1> QUESTION ".$_POST['currentquestion']." </h1><br>";
    echo "<p>" . $qtext . "</p><br>";

    echo '<form method="post" action="texam.php">';
    $i=0;
foreach($questions as $q){
    echo '<input type=hidden name=questions['.$i.'] value="'.$questions[$i].'">';
    $i=$i+1;
}
    echo '<input type=textbox name=answer><br>';
if ($number < count($questions)) {
    echo '<button type=submit name=currentnumber value='.($i+1).'> Next Question </button>';
}
if ($number != 0) {
    echo '<button type=submit name=current number value='.($i-1).'> Previous Question </button>';
}
    echo "</form>";

?>
</body>
