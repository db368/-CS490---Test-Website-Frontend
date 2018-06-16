<html>
<head>
    <title> Taking Exam </title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<?php //Initial Variable Definition
    $debug = 1;
    $questions = (isset($_POST['questions'])) ? $_POST['questions'] : die("No questions");
    $number = (isset($_POST['currentquestion'])) ? $_POST['currentquestion'] : die("No current quesiton number");
    $exid = (isset($_POST['exid'])) ? $_POST['exid'] : die("No Exid");
    $answers = (isset($_POST['answers'])) ? $_POST['answers'] : array(); // If this isn't set, it's likely the firs time this is called so create an answers array
    $qid = $questions[$number];
    ?>

    <header><h1> EXAM </h1> </header>
    <?php if($debug) : ?>
        <div class=debug>
            <h1> Incoming POST </h1>
            <?php echo var_dump($_POST); ?>

            <h1> Incoming questions </h1>
            <?php echo var_dump($questions) ?> <br>
            Current Question Number is <?php echo $number ?> " and the id is "<?php echo $qid ?> <br>
        </div>
    <?php
    endif;

    //CURL to get the actual useful question information;
    $target = "https://web.njit.edu/~jll25/CS490/switch.php";
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'qb_get_question', 'questionid' => $qid)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    curl_close($ch);

    $question=json_decode($return_val, true)[0];
    $qtext = $question["Question"];
    ?>

    <div class=login>
        <h1> QUESTION <?= $number ?> : </h1>
        <p> <?= $qtext ?> </p><br>

        <form method="post" action="texam.php">';
        <?php //Setup this loop
        $i=0;
        foreach($questions as $q){ ?>
            <input type=hidden name=questions[<?= $i ?>] value=<?= $questions[$i] ?>>
            <input type=hidden name=answers[<?= $i ?>] value=<?= $answers[$i] ?>>
        <?php $i=$i+1;
    }?>

                echo '<input type=textbox name=answer['.$number.'] value='. $answer[$number] .'><br>';
                echo '<input type=hidden name=exid value="'.$exid.'">';
                echo '<input type=hidden name=sid value="'.$_POST['sid'].'">';
if ($number < count($questions)-1) {
    echo '<button type=submit name=currentquestion value='.($number+1).'> Next Question </button>';
}
if ($number != 1) {
    echo '<button type=submit name=currentquestion value='.($number-1).'> Previous Question </button>';
}
        echo '<button type=submit name=identifier value=answer formaction="examlandingpage.php"> Submit answer </button>';
            echo "</form>";
        // Submit button stuff
         echo '<form method="post" action="examlandingpage.php">';
        //echo '<form method="post" action="../debug.php">';
        $i=0;
foreach($questions as $q){
    echo '<input type=hidden name=questions['.$i.'] value="'.$questions[$i].'">';
    echo '<input type=hidden name=answer['.$i.'] value="'.$answer[$i].'">';
    $i=$i+1;
}
        echo '<input type=hidden name=exid value="'.$exid.'">';
        echo '<input type=hidden name=sid value="'.$_POST['sid'].'">';
        echo '<button type=submit name=identifier value=answer> Submit answer </button>';
        echo '</form>';
        echo "</div>";
    ?>


</body>
