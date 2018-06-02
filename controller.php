<?php //Controller.php

// PHASE 1: AUTHENTICATION

if ($_POST['phase'] == '1') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~jll25/CS490/backend.php");
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query(array('username' => $_POST["username"], 'password' => $_POST["password"])));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);
    echo $return_val;
}
// PHASE 2: REDIRECTION
else{
    header("Location: https://web.njit.edu/~db368/CS490/instructor.html");
}
