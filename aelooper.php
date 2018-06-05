<?php
// AELOOPER: Send users back to exam managment interface after adding an exam.

//Send data to the DB
$target = 'https://web.njit.edu/~jll25/CS490/switch.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);


//Thankfully, qbank doesn't require any post data, so we can ust use a header for this one.

//header('Location: http://afsaccess3.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/mexam.php');

?>
