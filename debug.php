<?php //debug.php

// PHASE 1: AUTHENTICATION

//Print all posted variables
echo "<h2> POST CONTENTS </h2>";
foreach ($_POST as $name => $val)
{
     echo "<p>" $name . ':' . $val . " </p> <br>";
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://web.njit.edu/~jll25/CS490/backend.php");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query(array('username' => $_POST["username"], 'password' => $_POST["password"])));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
curl_close($ch);
//echo $return_val;
echo "<h3> Sending Post </h3>";

echo "USERNAME: " . $_POST["username"] . "<br>";
echo "PASSWORD: " . $_POST["password"] . "<br>";

echo "<h3> Raw Returned Json: </h3>" .  $return_val . "<br> <br>";

echo "<h3> var_dump of json_decode for returned json:</h3> "; 
echo var_dump(json_decode($return_val));
echo "<br> <br>";

$jason = json_decode($return_val, true);
echo "<h3> Attempted reading of role from returned json:</h3> ";
echo " role:" . $jason["Role"];
?>

