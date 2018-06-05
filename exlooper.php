<?php
// LOOPER: Sends out a request, then goes to target url.
$target = 'http://afsaccess3.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/Druswitch.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);


//Finally, we load the url that we wanted to redirect to.
//One little tweak to the post
$_POST['id'] = $_POST['eid'];
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
