<html>
<head>
    <title> Debug </title>
</head>

<body>
<h1> Debug.php </h1>
<?php //debug.php
//$target = "https://web.njit.edu/~jll25/CS490/switch.php";
//$target = "https://http://web.njit.edu/~jll25/CS490/switch.php";
//$target = "http://web.njit.edu/~db368/CS490/debug.php";

echo "Message Recieved";
$sid = $_POST['sid'];
$eid = $_POST['exid'];
$qid = $_POST['questions'];
$answers = $_POST['answer'];

for ($i=0; $i <sizeof($_POST['questions']); $i++) {
	$question_id = $qid[$i];
	$answer = $answers[$i];

	$insertquery = "INSERT INTO StudentResult(Student_id, Eid, Qid,Answer)
			    VALUES ('$sid','$eid', '$qid[$i]', '$answers[$i]');";
	echo '<br>';
	echo $insertquery;
}
echo "-------LIVE CODE ------";
$sid = $_POST['sid'];
$eid = $_POST['exid'];
$qid = $_POST['questions'];
$answers = $_POST['answer'];

$question_id = $qid[1];
$answer = $answers[1];

for ($i=0; $i <sizeof($_POST['questions']); $i++) {
  $question_id = $qid[$i];
  $answer = $answers[$i];
  $insertquery = "insert into StudentResult(Student_id, Eid, Qid,Answer) values ('$sid','$eid', '$qid[$i]', '$answers[$i]');";

echo $insertquery;
}
?>
</body>
</html>
