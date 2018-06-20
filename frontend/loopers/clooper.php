<?php
// CLOOPER: POSTS A COMMENT, THEN returns to the exam inspection page

//Send what we need to to the switch
$target = 'https://web.njit.edu/~jll25/CS490/switch.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);

$_POST['eid']=$_POST['exid'];
$target = 'https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/results/isdresults.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST); // Should work
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$reload=curl_exec($ch);
curl_close($ch);

echo $reload;

?>
