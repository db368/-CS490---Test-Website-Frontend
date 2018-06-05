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
    //EXAM TABLE
    $exams = array("Exam1", "Exam2", "Exam3");
    $ids = array("39", "393", "3939");
    $both = array_combine($ids, $exams);
    echo '<table width=100%>';
    echo '<tr><th> EXAMS </th></tr>';
    echo '<form action="debug.php" method="post">';
    echo '<input type="hidden" name="identifier" value="e_get_questions">';
foreach ($both as $id => $exam){
    echo '<tr>';
    echo '<td> <button type="submit" class="link-button" name="id" value="' . $id .'">'. $exam . '</button> </td>';
    echo '</tr>';

}
    echo '</form>';
    echo '</table>';
?>

</div>
<div>
    <h2> Add new exam </h2>
    <form action="http://afsaccess3.njit.edu/~db368/CS490/debug.php" method="post">
        <input type="hidden" name = "identifier" value="a_exam">
        <input type="text" name="examname">
        <input type="submit" value="Add Exam">
    </form>
</div>
</body>
</html>
