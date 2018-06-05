<?php //Druswitch.php

//First of all, I'm not uploading the password/username to github. That's a bad idea. Instead lets load it from a secret config file.
if !isset($_POST['identifier']) {echo "No identifier!"; exit;
}

$secretfilepath = "/afs/cad/u/d/b/db368/secret.ini";
$up = parse_ini_file($secretfilepath);
$username = $up['username'];
$password = $up['password'];
// Testing this will  be fun

$datab = mysqwli_connect("sql1.njit.edu", $username, $password, $username);
if (mysqli_connect_errno()) {echo "Something went wrong". mysqli_connect_error; exit;
}

//Lets hope we make it this far
switch($_POST['identifier']){
case "aq_exam":
    $eid = $POST['eid'];
    $qid = $POST['qid']
    $score = $POST['score']
    $add ="Insert into ExQuestions (Exam_id, Question_id, Total_points ) VALUES ('.$eid.', '.$qid.','.$score.')";
    if ($datab->query($add));
    {
        echo "SUCCESS!";
    }
    else{
        echo "FAILURE!";
    }


}

?>
