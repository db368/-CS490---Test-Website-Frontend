<?php //Druswitch.php

//First of all, I'm not uploading the password/username to github. That's a bad idea. Instead lets load it from a secret config file.
if (!isset($_POST['identifier'])) {echo "No identifier!";}
//echo var_dump($_POST);
//echo "Is this thing on?";
$secretfilepath = "secret.ini";
$up = parse_ini_file($secretfilepath);
$username = $up['username'];
$password = $up['password'];
// Testing this is fun

$datab = new mysqli("sql1.njit.edu", $username, $password, $username);
if (mysqli_connect_errno()) 
{echo "Something went wrong";
}

//Lets hope we make it this far
switch($_POST['identifier']){
case "aq_exam":
    $eid = $_POST['eid'];
    $qid = $_POST['qid'];
    $score = $_POST['score'];
 
    $add ="INSERT INTO ExQuestions (Exam_id, Question_id, Total_points) 
	   VALUES ('$eid', '$qid', '$score')";

sleep(1); //Give the DB some time to update
if (!$datab->query($add))
    {
        echo "FAILURE!";
    }

}

?>
