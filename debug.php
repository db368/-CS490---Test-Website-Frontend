<html>
<head>
    <title> Debug </title>
</head>

<body>
<h1> Debug.php </h1>
<?php //debug.php
$target = "https://web.njit.edu/~jll25/CS490/switch.php";
echo "Posting to: " . $target . "<br>";
echo "<h3> Post Variables </h3>";

if (!(isset($_POST))) {
        echo "NO POST DUDE";
        exit;
}
foreach ($_POST as $name => $val){
    if (is_array($val)) {
               echo " " . $name . ':';
               echo var_dump($val) . "<br>";
    }
    else {
            echo " " . $name . ':' . $val . "<br>";
    }
}

if ($target != "none") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
        echo "<h3> Raw Returned Json: </h3>" .  $return_val . "<br> <br>";

        echo "<h3> var_dump of json_decode for returned json:</h3> ";
        echo var_dump(json_decode($return_val));
        echo "<br> <br>";

        echo "<h3> Cool formatted version of the JSON </h3>";
        $jarray = json_decode($return_val, true);
    foreach ($jarray as $name => $val){
            echo " " . $name . ':' . $val . "<br>";
    }
}

?>
</body>
</html>
