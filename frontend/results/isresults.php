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
    <link rel="stylesheet" href="../styles.css">

</head>
<body>
    <?php
    echo "<h1> RESULTS FOR ".$_POST['exname']."</h1>";
        //First, we get a list of exams
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'results', 'eid'=> $_POST['eid'])));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);
    if ($return_val == null) {
        echo "<h3> ERROR: EXAM LIST COULD NOT BE RETRIEVED </h3>";
        exit;
    }
    $results = json_decode($return_val, true);
    //var_dump($exams);
    echo "<table>";
    echo "<tr> <th> STUDENT </th> <th> AVERAGE </th> </tr>"; //Only need to do a single form I think
    foreach($results as $student){
        echo "<tr>";
        $exid = "error"; $exname = "error";
        if (isset($student['sid'])) { $sid = $exam['sid'];
        }
        if (isset($student['average'])) { $average = $exam['average'];
        }
        echo '<form method="post" action="../debug.php">';
        echo '<input type="hidden" name="sid" value="'.$sid.'">';
        echo '<td> <button type="submit" class="link-button" name="identifier" value="s_results"> '.$sid.' </button> </td>';
        echo "</form></tr>";
    }
    echo "</table>";

    ?>

</body>
</html>
