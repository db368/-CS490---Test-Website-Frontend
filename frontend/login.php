<?php
//login info to connect to the database
$serv = 'sql.njit.edu';
$user = 'jll25';
$pass = 'EzzrnW0B0';
$db ='jll25';

//checks to see if the backend php gets the information from the middle

if(!isset($_POST['username']))die('Error: No Username');
if(!isset($_POST['password']))die('Error: No password!');

$user = $_POST['username'];

$pw = $_POST['password'];



$conn = mysqli_connect("sql1.njit.edu", "jll25", "EzzrnW0B0", "jll25");

if ($conn->connect_error){
	die("Connection failure" . $conn->connect_error);
}
else
{
//getting the credentials if they are there
$sql = "SELECT Cred.Role, Cred.Username, Cred.Student FROM Cred where Username ='$user' && Password='$pw'";

$result = $conn->query($sql);
$json_array = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$json_array[]=$row;
	}
$encoded = json_encode($json_array);

echo $encoded;


} else {
	//if the information is not correct it will go here.
	$invalid = "select Role from Cred where Username = 'Invalid';";
	$in = $conn->query($invalid);
	$invalid_array = array();
	if ($in->num_rows > 0) {

    while($row = $in->fetch_assoc()) {
    	$invalid_array[]=$row;
}
$inv = json_encode($invalid_array);
echo $inv;


}


$conn->close();

		}

}

?>
