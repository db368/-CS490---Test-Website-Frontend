<?php //Druswitch.php

//Forbidden Code
if (!isset($_POST['identifier'])) {die("No identifier!");
}
$secretfilepath = "secret.ini";
$up = parse_ini_file($secretfilepath);
$username = $up['username'];
$password = $up['password'];
// Testing this is fun

$datab = new mysqli("sql1.njit.edu", $username, $password, $username);
if (mysqli_connect_errno()) {echo "Something went wrong";
}

//Lets hope we make it this far
switch($_POST['identifier']){
case "aq_exam":
    $eid = $_POST['id'];
    $qid = $_POST['qid'];
    $score = $_POST['score'];

    $add ="INSERT INTO ExQuestions (Exam_id, Question_id, Total_points)
	   VALUES ('$eid', '$qid', '$score')";

    sleep(1); //Give the DB some time to update
    if (!$datab->query($add)) {
        echo "FAILURE!";
    }
    break;
case "a_testbank":
    $diff = $_POST['difficulty'];
    $question = $_POST['question'];
    $testcases = $_POST['testcase'];
    $solutions = $_POST['solutions'];

    echo json_encode($testcases);
    break;
}
?>
