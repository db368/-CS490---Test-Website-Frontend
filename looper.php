<?php// LOOPER: Sends out a request, then goes to target url.

//Send data to the DB
$target = "https://web.njit.edu/~jll25/CS490/switch.php";
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

//Finally, we load the url that we wanted to redirect to.
$target = 'http://afsaccess3.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/eexam.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST); // Should work
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$reload=curl_exec($ch);
curl_close($ch);

echo $reload;

?>
