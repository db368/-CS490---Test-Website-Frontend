<html>

<head>
    <title> Exam Submitted</title>

</title>

<body>
<?php
    //Send answers to the server
    $target = 'https://web.njit.edu/~jll25/CS490/switch.php';
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);

?>
    <h2> The exam is now finished </h2>
    <a href="vexams.php">  Click here to return to the exam dialog </a>
</body>

</html;
