<?php
// QBLOOPER: Sends out a request, then goes to target url.
//   ^S
//Send data to the DB

if ($_POST["identifier"] != "doesntmatter"){
$target = 'https://web.njit.edu/~jll25/CS490/switch.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
}
else{
	$_POST["numtc"]+=1; //Increment this
}

//now this does use post data so it needs a curl

$target = 'https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/qbank/addqsplit.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$reload=curl_exec($ch);
curl_close($ch);

echo $reload;



?>
