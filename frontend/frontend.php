<?php //FRONTEND.PHP

/* variables */
$studenturl="dummy";
$instructorurl = "https://web.njit.edu/~jll25/CS490/backend.php";
$unknownurl = "ui.html";


//PHASE 1: AUTHENTICATION
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://afsaccess2.njit.edu/~db368/CS490/controller.php");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('username' => $_POST["username"], 'password' => $_POST["password"], 'phase' => '1')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

$jason = json_decode($return_val);
$role = $jason[0]->Role;
//PHASE 2: REDIRECTION
if ($role == "Student") {
    header('Location: http://afsaccess2.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/student.html');
} else if ($role == "Instructor") {
    header('Location: http://afsaccess2.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/instructor.html');
}else{
    header('Location: http://afsaccess2.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/ui.html');
}
exit;

//echo $return_val;
?>
