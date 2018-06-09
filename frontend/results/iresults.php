<html>
<head>
</head>
    <title> Results </title>
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

    $exams = json_decode($return_val);
    echo "<table>";
    echo "<tr> <th> EXAM </th> <th> RELEASE </th> </tr>"; //Only need to do a single form I think
    echo '<form target="../debug.php">';
    echo '<input type="hidden" name="identifier" value="results">';
    foreach($exams as $exam){
        echo "<tr>";
        $exid = "error"; $exname = "error";
        if (isset($exam['Eid'])) { $exid = $exam['Eid'];
        }
        if (isset($exam['Name'])) { $exname = $exam['Name'];
        }
        echo '<td> <button type="submit" class="link-button" name="id" value="'. $exid .'" </td>';
        echo '</tr>';
    }
    echo "</form>";
    echo "</table>";

    ?>

</body>
</html>
