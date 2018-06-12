<html>
<head>
    <title> Manage exams </title>
    <link rel="stylesheet" href="../styles.css">
<body>
<header><h1> Manage Exams </h1> </header>
<div>
<?php
    //Obtain Exams
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, "$target");
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_exams')));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);
if ($return_val == null) {
    //Cool get out of jail free card
    echo "<h2> No exams detected? Perhaps you'd like to add one? </h2>";
    echo '<div>
        <form action="../loopers/aelooper.php" method="post">
            <input type="hidden" name = "identifier" value="a_exam">
            <input type="text" name="examname">
            <input type="submit" value="Add Exam">
        </form>';
    exit;
}
    $exams = json_decode($return_val, true);

    echo '<table width=100%>';
    echo '<tr><th> EXAMS </th> <th> REMOVE </th> </tr>';
foreach ($exams as $exam){
    // Could probably wrap this up in a function eventually
    $exid = "error"; $exname = "error";
    if (isset($exam['Eid'])) { $exid = $exam['Eid'];
    }
    if (isset($exam['Name'])) { $exname = $exam['Name'];
    }

    echo '<tr>';
    //Edit Button
    echo '<form action="eexam.php" method="post">';
    echo '<input type="hidden" name="id" value="'.$exid.'">';
    echo '<td> <button type="submit" class="link-button" name="identifier" value="qb_get_question">'. $exname . '</button> </td>';
    echo '</form>';

    //In the future, if I want, I can put these buttons both in the same form using a custom looper
    //Remove Button
    //echo '<form action="../loopers/aelooper.php" method="post">'; //Send message through AE looper. Exact functionality we want.
    echo '<form action="../debug.php" method="post">'; //Send message through AE looper. Exact functionality we want.
    echo '<input type="hidden" name="eid" value="'.$exid.'">';
    echo '<td> <button type="submit" name="identifier" value="r_exam">'. REMOVE . '</button> </td>';
    echo '</form>';

    echo '</tr>';
}
    echo '</form>';
    echo '</table>';
?>

</div>
<div>
    <h2> Add new exam </h2>
    <form action="../loopers/aelooper.php" method="post">
        <input type="hidden" name = "identifier" value="a_exam">
        <input type="text" name="examname">
        <input type="submit" value="Add Exam">
    </form>
</div>
</body>
</html>
