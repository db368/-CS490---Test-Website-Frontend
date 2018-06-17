<?php

if(!isset($_POST['identifier'])) { die('Error: No identifier');
}
$identifier = $_POST['identifier'];



switch ($_POST['identifier'])
{
//view test questions
case "v_testbank":
    $difficulty = $_POST['difficulty'];
    $exam = $_POST['examid'];
    $conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

    if ($conn->connect_error) {
        die("Connection failure" . $conn->connect_error);
    }

    //getting the results from Questions if the post word is difficulty
    $sql = "SELECT * from Questions where Difficulty ='$difficulty'";

    $Difficulty_result = $conn->query($sql);
    $json_array = array();
    if ($Difficulty_result->num_rows > 0) {
        // output data of each row
        while($row = $Difficulty_result->fetch_assoc()) {
            $difficulty_array[]=$row;
        }
        $difficulty_encoded = json_encode($difficulty_array);

        echo $difficulty_encoded;

    }
    else {
        //getting results using examid

        $sql= "SELECT * FROM Questions WHERE NOT EXISTS (select Questions.Qid, Questions.Question, Questions.Difficulty from ExQuestions left join Questions on Questions.Qid = ExQuestions.Question_id where ExQuestions.Exam_id = '$exam')";
        //$sql = " select Questions.Qid, Questions.Question, Questions.Difficulty from ExQuestions left join Questions on Questions.Qid = ExQuestions.Question_id where ExQuestions.Exam_id = '$exam'";
        $Examid_result = $conn->query($sql);
        $json_array = array();
        if ($Examid_result->num_rows > 0) {
            // output data of each row
            while($row = $Examid_result->fetch_assoc()) {
                $Examid_array[]=$row;
            }
            $Exam_encoded = json_encode($Examid_array);

            echo $Exam_encoded;

        }
        else {
            //if there is neither examid, or difficulty
            $all = "select * from Questions;";
            $allqu = $conn->query($all);
            $all_array = array();
            if ($allqu->num_rows > 0) {

                while($row = $allqu->fetch_assoc()) {
                    $all_array[]=$row;
                }
                $allq = json_encode($all_array);
                echo $allq;
            }
        }
    }


    break;



//this views exams.
case "v_exams":
    $conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $viewe = "Select * from Exams;";
    $Exameview = $conn->query($viewe);
    $json_array = array();
    if ($Exameview->num_rows > 0) {
        // output data of each row
        while($row = $Exameview->fetch_assoc()) {
            $Examview_array[]=$row;
        }
        $Examv_encode = json_encode($Examview_array);

        echo $Examv_encode;

    }

    break;

//creates exams
case "a_exam":


    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    $ae = $_POST['examname'];

    $add = "Insert into Exams(Name) values ('$ae');";
    $addresult = $conn->query($add);
    if($addresult) {return 1;
    }
    else {return 0;
    }
    break;


//inserting to answer from students
case "answer":

$conn = new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

$sid = $_POST['sid'];
$eid = $_POST['exid'];
$qid = $_POST['questions'];
$answers = $_POST['answer'];

var_dump($answers);
var_dump($qid);

if(!is_array($qid)){echo "no array";}
else{var_dump($qid);}


for ($i=0; $i <sizeof($_POST['questions']) ; $i++) {
  $question_id = $qid[$i];
  $answer = $answers[$i];
  $answer = mysqli_real_escape_string($conn, $answer);

  $insertquery = "Insert into StudentResults(Student_id, Eid, Qid, Answer) values ('$sid', '$eid', '$qid[$i]', '$answer');";
  //echo '<br>';
  //echo $insertquery;
  if ($conn->query($insertquery) === TRUE) {
       echo "Student's answer added successfully";
   }
   else {
        echo "Error: " . $insertquery . "<br>" . $conn->error;}

/*
$select = "Select Answer from StudentResults where Eid = '$eid' and Qid = '$qid[$i]' and Student_id = '$sid';";
if ($conn->query($select) === TRUE) {
     echo "Here is the student's answer";
 }
 else {
      echo "Error: " . $select . "<br>" . $conn->error;}


$selects = $conn-

echo '<br>';
echo $select;
*/


}






//$question_id = $qid[1];

//$answer = $answers[1];
/*
$insertquery = "insert into StudentResult(Student_id,Eid, Qid,Answer) values ('$sid','$eid', '$question_id','$answer');";
echo $insertquery;

if($conn->query($insertquery)){
  echo "answer inserted";
}*/


    break;

//Used to grab all questions from exam id for editing an exam


case "e_get_questions":
    $eid = $_POST['id'];

    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $vieweq = "select Questions.Qid, Questions.Question, Questions.Difficulty, ExQuestions.Total_points from ExQuestions left join Questions on ExQuestions.Question_id = Questions.Qid where ExQuestions.Exam_id ='$eid'";

    $Exameview = $conn->query($vieweq);
    $json_array = array();
    if ($Exameview->num_rows > 0) {
        // output data of each row
        while($row = $Exameview->fetch_assoc()) {
            $Examview_array[]=$row;
        }
        $Examv_encode = json_encode($Examview_array);

        echo $Examv_encode;
    }
    else {return 0;
    }

    break;
//Get Question from id (to edit)
case "qb_get_question":

    $eq = $_POST['qb_get_question'];
    $qid = $_POST['questionid'];

    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $viewe = "select Questions.Question, TC.TestCase, TC.Answer, Questions.Difficulty from Questions left join TC on Questions.Qid= TC.Qid where Questions.Qid ='$qid'";
    $Exameview = $conn->query($viewe);
    $json_array = array();
    if ($Exameview->num_rows > 0) {
        // output data of each row
        while($row = $Exameview->fetch_assoc()) {
            $Examview_array[]=$row;
        }
        $Examv_encode = json_encode($Examview_array);

        echo $Examv_encode;
    }
    break;
//Used to grab all questions from exam id for editing an exam
case "e_get_question":

    $qid = $_POST['question_id'];

    $eid = $_POST['eid'];


    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $viewe = "select Questions.Question, Questions.Difficulty, ExQuestions.Total_points from ExQuestions left join Questions on ExQuestions.Question_id = Questions.Qid where ExQuestions.Exam_id = '$eid'and ExQuestions.Question_id ='$qid'";
    $Exameview = $conn->query($viewe);
    $json_array = array();
    if ($Exameview->num_rows > 0) {
        // output data of each row
        while($row = $Exameview->fetch_assoc()) {
            $Examview_array[]=$row;
        }
        $Examv_encode = json_encode($Examview_array);

        echo $Examv_encode;
    }
    else{return 0;
    }

    break;

//edit question

case "e_question":
    $qid = $_POST['qid'];
    $question = $_POST['question'];
    $difficulty = $_POST['difficulty'];
    $testcase = $_POST['testcase'];
    $answer = $_POST['solution'];
    $score = $_POST['score'];
    $order = $_POST['order'];


    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    $updatq = "UPDATE Questions SET Question = '$question' where Qid ='$qid'";
    $updateq = $conn->query($updatq);

    $updatescore = "UPDATE ExQuestions SET Total_points = '$score' where Question_id ='$qid'";
    $updatescore = $conn->query($updatescore);

    for ($i=0; $i <sizeof($testcase) ; $i++) {
      // code...
      $answer = mysql_real_escape_string($answer);

    $query = "Update TC set TestCase ='$testcase[$i]', Answer ='$answer[$i]', Order = '$order[$i]' where Qid ='$qid'";
    if ($conn->query($query) === TRUE) {
         echo "TestCase and Solution added successfully";
     }
     else {
          echo "Error: " . $query . $conn->error;}
        }
     if ($conn->query($query) === TRUE) {
        	echo "TestCase added successfully";
    	}
    	else {
       		 echo "Error: " . $query . "<br>" . $conn->error;}

        $add= "Insert into Questions(Question, Difficulty) values ('$question', '$difficulty');";



/*
    $updatetc =  "UPDATE TC SET TestCase = '$testcases' where Question_id ='$qid'";
    $updateq = $conn->query($updatq);

    $updatetc =  "UPDATE TC SET TestCase = '$answer' where Question_id ='$qid'";
    $updateq = $conn->query($updatq);

    /*
    $update = "UPDATE Questions SET Question='$question','Difficulty'='$difficulty' WHERE Qid = '$qid'";
    $addresult = $conn->query($update);
    if($addresult)
    {
    if(!isset($_POST['testcases'])){ return 1;}
    else {
    if(!isset($_POST['solutions'])){return 1;}
    else{
    $update2 = "UPDATE 'TC' SET TestCase= '$testcases', Answer ='$answer' WHERE Qid = '$qid'";
    $updateresult =  $conn->query($update2);
    if($updateresult)
    {return 1;}
    else{ $update2 = "UPDATE 'TC' SET 'Case'='$testcases'WHERE Qid = '$qid'";
    $updateresult =  $conn->query($update2);
    if($updateresult)
    {return 1;}
    else{return 0;}
    }
    }
    }
    }*/
    break;

//delete
case "req_exam":

    $eid = $_POST['eid'];

    $qid = $_POST['qid'];

    if(isset($_POST['qid'])) {
        $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
        $deleteq ="Delete from ExQuestions where Exam_id = '$eid' and Question_id ='$qid'";
        $deleteqresult = $conn->query($deleteq);
        if($deleteqresult) {
            return 1;
        }
        else {return 0;
        }
    }

    break;

//add question to test bank
case "a_testbank":
    $ate = $_POST['a_testbank'];
    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");


    $question = $_POST['question'];
    $difficulty = $_POST['difficulty'];
    $case = $_POST['testcase'];
    $solution = $_POST['solution'];
    var_dump($case, $solution);
    print $case[0];

    //$getai = "SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jll25' AND TABLE_NAME = 'Questions';";
    //$getairesult = $conn->query($getai);
    //echo $getairesult;
    $tc = "TC";
    $TCquery =mysqli_query("show tables status where name = '$TC' ");
    $row = mysql_fetch_array($TCquery);
    $next_inc_value =$row["AUTO_INCREMENT"];




    $add= "Insert into Questions(Question, Difficulty) values ('$question', '$difficulty');";
      if ($conn->query($add)=== TRUE) {
          $last_id = $conn->insert_id;
              echo "question added successfully";
            }
              else {
                echo "Error: " . $add . "<br>" . $conn->error;}
      for ($i=0; $i <sizeof($case) ; $i++) {
        // code...

      $query = "insert into TC(Qid, TestCase, Answer) values('$last_id','$case[$i]','$solution[$i]')";
      if ($conn->query($query) === TRUE) {
           echo "TestCase and Solution added successfully";
       }
       else {
            echo "Error: " . $query . $conn->error;}
          }

                /*foreach($case as $index=>$col){
                $query = "insert into TC( TestCase, Answer) values('$case[$index]','$solution[$index]'),";


                $query = rtrim( $query, ',');

                 if ($conn->query($query) === TRUE) {
                    	echo "TestCase added successfully";
                	}
                	else {
                   		 echo "Error: " . $query . $conn->error;}
                     }

      /*for ($i=0; $i < sizeof($case) ; $i++) {
        $testcaseresult = "Insert into TC(Eid,TestCase,Answer) values '$getairesult','$case[$i]','$solution[$i]';";
 			  $testcaseresultq= $conn->query($testcaseresult);
 			  if(!$testcaseresultq){echo "error";}

      }



    /*
    foreach($case as $index=>$col){
    $query = "insert into TC(TestCase, Answer) values('".$case[$index]."','".$solution[$index]."');";
    }

    $query = rtrim( $query, ',');
    mysqli_query($conn,$query);
     if ($conn->query($query) === TRUE) {
        	echo "TestCase added successfully";
    	}
    	else {
       		 echo "Error: " . $query . "<br>" . $conn->error;}
*/
    break;

//add question to exam

case "aq_exam":
    $aqe= $_POST['aq_exam'];

    $eid = $_POST['eid'];
    $qid = $_POST['qid'];
    $score = $_POST['score'];


    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

    //add if exists to put number in
  //  $add ="INSERT INTO ExQuestions(Exam_id, Question_id, Total_points) VALUES ('$eid','$qid','$score');";
    //ddresult = $conn->query($add);


    $ieq ="INSERT INTO ExQuestions (Exam_id, Question_id, Total_points)
    VALUES ('$eid','$qid','$score')
    ON DUPLICATE KEY
    UPDATE Total_points = '$score';";

     if ($conn->query($ieq) === TRUE) {
        	echo "Added Exam question  successfully";
    	}
    	else {
       		 echo "Error: " . $ieq . "<br>" . $conn->error;
    	}

    break;

//remove an exam
case 'r_exam':
    $eid = $_POST['eid'];
    $conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

    $deleteq ="Delete from ExQuestions where Exam_id = '$eid'";
    if ($conn->query($deleteq) === TRUE) {
        echo "Exam questions deleted successfully";
    } else {
        echo "Error: " . $deleteq . "<br>" . $conn->error;
    }

    $remove = "Delete from Exams where eid ='$eid';";
    if ($conn->query($remove) === TRUE) {
        echo "Exam deleted successfully";
    } else {
        echo "Error: " . $remove . "<br>" . $conn->error;
    }
    break;

case 'release':
	$eid = $_POST['eid'];
	$conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
	$release = "update Exams set Release_Ready ='1' where eid ='$eid'";

	if ($conn->query($release) === TRUE) {
	    	echo "Exam is ready to be released";
	}
	else {
   		 echo "Error: " . $release . "<br>" . $conn->error;}


break;

case "r_testbank":

$qid = $_POST['id'];

$conn =  new mysqli("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
$deleteeq = "delete from ExQuestions where Question_id= '$qid'";
if ($conn->query($deleteeq) === TRUE) {
      echo "Exam questions has been deleted";
}
else {
     echo "Error: " . $deleteeq . "<br>" . $conn->error;}

$deleteq = "delete from Questions where Qid= '$qid'";
     if ($conn->query($deleteq) === TRUE) {
           echo "Questions has been deleted from the Testbank";
     }
     else {
          echo "Error: " . $deleteq . "<br>" . $conn->error;}

break;

case "results":


$eid = $_POST['eid'];






$conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

if ($conn->connect_error) {
    die("Connection failure" . $conn->connect_error);
}

$Students = "select Student_id, sum(score) from StudentResults where Student_id in (select Stid from Student) and StudentResults.Eid ='$eid' group by Student_id;";

$Studentsr = $conn->query($Students);
$json_array = array();
if ($Studentsr->num_rows > 0) {
    // output data of each row
    while($row = $Studentsr->fetch_assoc()) {
        $studentid[]=$row;
    }
    $student_encoded = json_encode($studentid);

    echo $student_encoded;
}


break;

case "s_results":

$sid = $_POST['sid'];
$eid = $_POST['eid'];

$conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");
if ($conn->connect_error) {
    die("Connection failure" . $conn->connect_error);
}

$sql = "select distinct Questions.Question, Questions.Qid, StudentResults.score, ExQuestions.Total_points from StudentResults inner join Questions on Questions.Qid = StudentResults.Qid inner join ExQuestions on StudentResults.Eid = ExQuestions.Exam_id where StudentResults.Student_id = '$sid' and StudentResults.Eid = '$eid' group by Questions.Question";

$Score = $conn->query($sql);
$json_array = array();
if ($Score->num_rows > 0) {
    // output data of each row
    while($row = $Score->fetch_assoc()) {
        $scorenum[]=$row;
    }
    $score_encoded = json_encode($scorenum);

    echo $score_encoded;
}

break;

case "c_comment":

$comment = $_POST['comment'];
$newgrade = $_POST['newgrade'];
$eid = $_POST['exid'];
$qid = $_POST['qid'];
$sid = $_POST['sid'];

$conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

for ($i=0; $i <sizeof($comment) ; $i++) {
  $comment = $mysqli->real_escape_string($comment);
  $sql = "update StudentResults set Score = '$newgrade[$i]', Result = '$comment[$i]' where Eid = '$eid' and Qid = '$qid' and Student_id = '$sid'";
  if ($conn->query($comment) === TRUE) {
        echo "Student score has been updated";
  }
  else {
       echo "Error: " . $comment . "<br>" . $conn->error;
     }


  $grade = "insert into Updated_Grades(Stid, Eid, Qid, Grade) values ('$sid','$eid','$qid','$newgrade[$i]');";
  if ($conn->query($grade) === TRUE) {
        echo "Score change has been documented";
  }
  else {
       echo "Error: " . $grade . "<br>" . $conn->error;}


}

break;

case "g_comment":
$eid = $_POST['exid'];
$qid = $_POST['questionid'];
$sid = $_POST['sid'];


$conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");


$sql = "select Result, Score from StudentResults where Eid = '$eid' and Student_id = '$sid' and Qid = '$qid';";


$comment  = $conn->query($sql);
$json_array = array();
if ($comment->num_rows > 0) {
    // output data of each row
    while($row = $comment->fetch_assoc()) {
        $comment_row[]=$row;
    }
    $comment_encoded = json_encode($comment_row);

    echo $comment_encoded;

}


  break;


default:
    header('Location: https://web.njit.edu/~jll25/CS490/student.html');
}




?>
