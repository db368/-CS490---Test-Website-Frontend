<html>
<head>
    <title> Taking Exam </title>
</head>
<body>
<?php
    $questions = $_POST['questions'];
    $number = $_POST['currentquestion'];
    $qid = $questions[$number];
   
    echo "<h1> Incoming questions </h1>"; 
    echo var_dump($questions);
    echo "<br> Current Question Number is ". $number. " and the id is ". $qid . "<br>";

   //CURL to get the actual useful question information; 
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question', 'questionid' => $qid)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);
    
    echo "<h1> RETURN FROM THE SERVER </h1> <br>";	
    $question=json_decode($return_val, true)[0];
    var_dump($question);
    $qtext = $question["Question"];

    echo "<h1> QUESTION ".$number." </h1><br>";
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
if ($number != 1) {
    echo '<button type=submit name=current number value='.($i-1).'> Previous Question </button>';
}
    echo "</form>";

?>
</body>
