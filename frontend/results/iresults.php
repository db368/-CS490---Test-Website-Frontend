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
th{
    background-color: gray;
}

tr:nth-child(even){
    background-color:lightgray;
    padding: 16px;
}
</style>
<head>
    <title> Results </title>
</head>
<body>
    <h1> Results By Exam </h1>
    <p> Click on an exam to get a student by student breakdown, or click on the release button to release an exam to the students </p>

    <?php
        //First, we get a list of exams
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_exams')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
    if ($return_val == null) {
        echo "<h3> ERROR: EXAM LIST COULD NOT BE RETRIEVED </h3>";
        exit;
    }
    $exams = json_decode($return_val, true);

    //var_dump($exams);
    echo "<table>";
    echo "<tr> <th> EXAM </th> <th> RELEASE </th> </tr>"; //Only need to do a single form I think
    foreach($exams as $exam){
        echo "<tr>";
        $exid = "error"; $exname = "error";
        if (isset($exam['Eid'])) { $exid = $exam['Eid'];
        }
        if (isset($exam['Name'])) { $exname = $exam['Name'];
        }
        echo '<form method="post" action="../debug.php">';
        echo '<input type="hidden" name="id" value="'.$exid.'">';
        echo '<td> <button type="submit" class="link-button" name="identifier" value="results"> '.$exname.' </button> </td>';
        echo '<td> <button type="submit" name=identifier value="release"> RELEASE  </button> </td>';
        echo "</form></tr>";
    }
    echo "</table>";

    ?>

</body>
</html>
