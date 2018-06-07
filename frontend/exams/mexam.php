<html>
<style>
.inline {
    display: inline;
}

.link-button {
    background: none;
    border: none;
    color: black;
    text-decoration: underline;
    cursor: pointer;
    font-size: 1em;
    font-family: serif;
}

.link-button:focus {
    outline: none;
}

.link-button:active {
    color: red;
}

th, td{
    border:1px solid;
    padding: 8px;
    text-align: center;
}

tr:nth-child(even){
    background-color:lightgray;
    padding: 16px;
}

</style>
<body>
<h1> Manage Exams </h1>
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
    echo "<h1> ERROR: NO RETURN VALUE </h1>";
    exit;
}
    $exams = json_decode($return_val, true);

    //Build Table
    /* Test Code
    $exams = array("Exam1", "Exam2", "Exam3");
    $ids = array("39", "393", "3939");
    $both = array_combine($ids, $exams);
    */

    echo '<table width=100%>';
    echo '<tr><th> EXAMS </th></tr>';
    echo '<form action="eexam.php" method="post">';
    echo '<input type="hidden" name="identifier" value="e_get_questions">';
foreach ($exams as $exam){
    // Could probably wrap this up in a function eventually
    $exid = "error"; $exname = "error";
    if (isset($exam['Eid'])) { $exid = $exam['Eid'];
    }
    if (isset($exam['Name'])) { $exname = $exam['Name'];
    }

    echo '<tr>';
    echo '<td> <button type="submit" class="link-button" name="id" value="' . $exid .'">'. $exname . '</button> </td>';
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
