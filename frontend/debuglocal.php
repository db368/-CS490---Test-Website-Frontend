<html>
<head>
    <title> Debug </title>
</head>

<body>
<h1> Debug.php </h1>
<?php //debug.php
//$target = "https://web.njit.edu/~jll25/CS490/switch.php";
//$target = "https://http://web.njit.edu/~jll25/CS490/switch.php";
//$target = "http://web.njit.edu/~db368/CS490/debug.php";

echo "<h3> Post Variables </h3>";
var_dump($arr);
$arr = $_POST[0];
while (isarray($arr)){
    var_dump($arr);
    echo "<br>";
    $arr=$arr[0];
}
?>
</body>
</html>
