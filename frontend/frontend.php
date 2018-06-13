<?php //FRONTEND.PHP

/* variables */
$studenturl="dummy";
$instructorurl = "https://web.njit.edu/~jll25/CS490/backend.php";
$unknownurl = "ui.html";


//PHASE 1: AUTHENTICATION
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~db368/CS490/controller.php");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('username' => $_POST["username"], 'password' => $_POST["password"], 'phase' => '1')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

$jason = json_decode($return_val, true)[0];
$role = $jason['Role'];
//PHASE 2: REDIRECTION

//This is going to be a curl instead of headers
switch ($role){
	case "Student":
	case "student":
		 $target="https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/student.php";
        break;
case "Instructor":
    $target = 'https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/instructor.php';
	break;
default:
    $target='https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/ui.html';
	break;
}
//Now we curl the page based on the user's role
$_POST['sid']=$_POST['Student'];
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$reload=curl_exec($ch);
curl_close($ch);
echo $reload;
//echo $return_val;
?>
