<?php //DEBUGLOOPER: An admission of defeat


$target = "https://web.njit.edu/~jll25/CS490/switch.php";
//$target = "https://http://web.njit.edu/~jll25/CS490/switch.php";
//$target = "http://web.njit.edu/~db368/CS490/debug.php";

if ($target != "none") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
        curl_close($ch);
        echo $return_val;

}

?>
