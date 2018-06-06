<html>
<head>
    <title> Taking Exam </title>
</head>
<body>
<?php
    $questions = $_POST['questions'];
    $number = $_POST['currentquestion'];
    if (isset($_POST['answers'])){
	 $answers = $_POST['answers'];
    }
    else {
	$answers = array(); 
    }
    $qid = $questions[$number];
    echo "<h1> Incoming POST </h1>"; 
    echo var_dump($_POST);

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

    echo "<h1> CURRENT ANSWERS </h1><br>";
    echo var_dump($answers);

    echo "<h1> QUESTION ".$number." </h1>";
    echo "<p>" . $qtext . "</p><br>";


//Now we get to do the fun work of posting it again
echo '<form method="post" action="texam.php">';
$i=0;
foreach($questions as $q){
    echo '<input type=hidden name=questions['.$i.'] value="'.$questions[$i].'">';
    echo '<input type=hidden name=answers['.$i.'] value="'.$answers[$i].'">';
    $i=$i+1;
}

    echo '<input type=textbox name=answers['.$number.'] value='. $answers[$number] .'><br>';
if ($number < count($questions)-1) {
    echo '<button type=submit name=currentquestion value='.($number+1).'> Next Question </button>';
}
if ($number != 1) {
    echo '<button type=submit name=currentquestion value='.($number-1).'> Previous Question </button>';
}
    echo "</form>";

?>
</body>
