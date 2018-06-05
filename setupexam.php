<?php
//Get the questions for the exam
$target = "https://web.njit.edu/~jll25/CS490/switch.php";
//$target = "http://afsaccess3.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/debug.php";
echo 'attempting to post'.$_POST;
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, array('identifier'=>'e_get_questions', 'id' => $_POST["id"]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

echo $return_val;
if ($return_val == null) {
    echo "<h1> ERROR: NO RETURN VALUE </h2>";
}
/*
//Test JSON
$target = "debug.php";
$ch2= curl_init();
curl_setopt($ch2, CURLOPT_URL, "$target");
curl_setopt($ch2, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($return_val));
$return_debug=curl_exec($ch2);
curl_close($ch2);

echo $return_debug;
/*
$qjson = json_decode($qreturn, true);
$i=0;
$qarray = array()
foreach ($qjson as $question){
    $qarray[$i]=$question; // Build a new array with numbers as keys
    i++;

}
$alarray = array(); //Build an almighty array to hold the questions and manage other info
$alarray['questions']=$qarray;
$alarray['currentquestion'] = '1';

$target = "etake.php";
$ch2= curl_init();
curl_setopt($ch2, CURLOPT_URL, "$target");
curl_setopt($ch2, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch2, CURLOPT_POSTFIELDS, http_build_query($alarray);
//curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch2);
curl_close($ch2);

?>
*/
