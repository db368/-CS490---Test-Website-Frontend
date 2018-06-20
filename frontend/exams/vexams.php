<html>
<head>
        <title> View Exams </title>
        <link rel="stylesheet" href="../styles.css">

</head>
<body>
<header> <h1> Available Exams </h1> </header>
<div class="login">
<?php
    //Obtain Exams
$target = "https://web.njit.edu/~jll25/CS490/switch.php";
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_exams')));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$return_val=curl_exec($ch);
if ($return_val == null) {
    echo "<h1> ERROR: EXAM LIST COULD NOT BE RETRIEVED </h1>";
    exit;
}
$exams = json_decode($return_val, true);


$sid = (isset($_POST['sid'])) ? $_POST['sid'] : exit("No Student ID!") ;
echo "<p> Click on an exam to take it! </p>";
//Build Table
/* Test Code
$exams = array("Exam1", "Exam2", "Exam3");
$ids = array("39", "393", "3939");
$both = array_combine($ids, $exams);
*/

echo '<table width=100%>';
echo '<tr><th> EXAMS </th></tr>';
echo '<form action="setupexam.php" method="post">';
echo '<input type="hidden" name="identifier" value="e_get_questions">';


foreach ($exams as $exam){
    //First of all, lets see if this thing has any questions
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'e_get_questions', 'id' => $exam["Eid"])));
    if (curl_exec($ch) == null) {
        continue;
    }

    $release_status = (isset($exam['Release_ready'])) ? $exam['Release_ready'] : 0 ;
    echo $release_status;
    if ($release_status == 0) //Don't display this exam if it's not released
        continue;
    $exid = "error"; $exname = "error";
    if (isset($exam['Eid'])) { $exid = $exam['Eid'];
    }
    if (isset($exam['Name'])) { $exname = $exam['Name'];
    }

    echo '<tr>';
    echo '<input type=hidden name=sid value="'.$sid.'">';
    echo '<td> <button type="submit" class="link-button" name="id" value="' . $exid .'">'. $exname . '</button> </td>';
    echo '</tr>';
}
curl_close($ch);
echo '</form>';
echo '</table>';
?>

</div>
<div>
   </div>
</body>
</html>
