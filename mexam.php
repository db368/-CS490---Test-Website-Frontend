<html>
<style>

</style>
<body>
<h1> Manage Exams </h1>
<div>
<?php
    //EXAM TABLE
    $exams = array("Exam1", "Exam2", "Exam3");
    $ids = array("39", "393", "3939");
    $both = array_combine($ids, $exams);
//    echo '<table>';
 //   echo '<th>';
    echo '<form action="debug.php" method="post">';
    echo '<input type="hidden" name="identifier" value="e_get_questions">';
foreach ($both as $id => $exam){
    echo '<button type="submit" name="id" value=' . $id .'>';
    echo $exam;
    echo '</button> <br>';
}
    echo '</form>';
?>
</div>
<div>
    <h2> Add a new exam </h2>
    <form action="http://afsaccess3.njit.edu/~db368/CS490/debug.php" method="post">
        <input type="hidden" name = "identifier" value="a_exam">
        <input type="text" name="examname">
        <input type="submit" value="Add Exam">
    </form>
</div>
</body>
</html>
