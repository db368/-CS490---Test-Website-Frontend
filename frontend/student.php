<html>

<head>
    <title> Student Landing Page </title>
	<link rel="stylesheet" href="styles.css">
<style>

</style>
</head>

<body>
 	<div class="debug"> 
	<h3> POST ARRAY</h3>  
     	<?php 
	var_dump($_POST);
	$username = (isset($_POST['username'])) ? $_POST['username'] : "Oh no";
	echo "</div>";
	echo "<div>";
	
	echo "<h1> Welcome ".$username."!</h1>";	
	echo "<form method=post action=debug.php>";
    	echo '<input type="hidden" name="username" value="'.$username.'"><br>';
    	
	//echo '<a class="click-me" href="exams/vexams.php">View Exams</a><br>';
    	//echo '<a class="click-me" href="ui.php"> Logout </a> <br>';
        echo "<div class=form>";	
	echo '<button type="submit"> View Exams </button><br>';
    	echo '<button type="submit"> Logout </button><br>';
	echo "</div>";
	echo "</div>";
	?>
</body>

</html>
