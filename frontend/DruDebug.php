<html>
<head>
    <title> Local Debug </title>
</head>

<body>
<h1> Debug.php </h1>
<?php //debug.php
$target = "http://afsaccess2.njit.edu/%7Edb368/CS490_git/CS490-Test-Website-Frontend/frontend/DruDebug.php";
//$target = "https://http://afsaccess2.njit.edu/~jll25/CS490/switch.php";
//$target = "http://afsaccess2.njit.edu/~db368/CS490/debug.php";

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
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
    if ($return_val == null) {
        echo "<h1> RETURNED NULL <h1>";
        exit;
    }
        echo "<h3> Raw Returned Json: </h3>" .  $return_val . "<br> <br>";

        echo "<h3> var_dump of json_decode for returned json:</h3> ";
        echo var_dump(json_decode($return_val));
        echo "<br> <br>";

        echo "<h3> Cool formatted version of the JSON </h3>";
        $jarray = json_decode($return_val, true);
    foreach ($jarray as $name => $val){
        if (is_array($val)) {
                   echo " " . $name . ':';
                   echo var_dump($val) . "<br>";
        }
        else {
                echo " " . $name . ':' . $val . "<br>";
        }
    }

}

?>
</body>
</html>
