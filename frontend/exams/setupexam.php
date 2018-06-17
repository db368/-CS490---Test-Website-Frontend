<?php
//Get the questions for the exam
$target = "https://web.njit.edu/~jll25/CS490/switch.php";
//$target = "http://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/debug.php";
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'e_get_questions', 'id' => $_POST["id"])));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

//echo $return_val;
if ($return_val == null) {
    echo "<h1> ERROR: NO RETURN VALUE </h2>";
}

//Get Qbank
$ch3= curl_init();
curl_setopt($ch3, CURLOPT_URL, "$target");
curl_setopt($ch3, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch3, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_testbank')));
$qb_return=curl_exec($ch3);
curl_close($ch3);


$uqarray = array();                         //Final destination for question ids
$eqarray = json_decode($return_val, true);  //Question Bank Array
$qbarray = json_decode($qb_return, true);   //Exam Questions
$usedids = array();                         //Make a little sub array to handle duplicates

foreach ($eqarray as $eq)
{
    array_push($usedids, $eq['Qid']);
}

var_dump($usedids);


$alarray = array();
$alarray['exid'] = $_POST["id"];
$alarray['questions']=$usedids;
$alarray['currentquestion']='0';
$alarray['sid'] = $_POST['sid'];

$target = "https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/exams/texam.php";
//$target = "http://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/debug.php";
$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, "$target");
curl_setopt($ch2, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($alarray));
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
$page = curl_exec($ch2);
curl_close($ch2);

echo $page;

?>
