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
    $sid = (isset($_POST['sid'])) ? $_POST['sid'] : die("No Student ID!");
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
        <h1> QUESTION <?php echo $number +1?> : </h1>
        <p> <?php echo $qtext ?> </p><br>

        <form method="post" action="texam.php">
            <?php //Setup this loop
            $i=0;
            foreach($questions as $q){ ?>
                <input type=hidden name=questions[<?php echo $i ?>] value=<?php echo $questions[$i] ?>>
                <input type=hidden name=answers[<?php echo $i ?>] value=<?php echo $answers[$i] ?>>
            <?php $i=$i+1;  //So here's how this is going to go. The displayed number is going to be one greater than the actual index
            }?>

            <textarea name=answer[<?php echo $number ?>] value= <?php echo $answer[$number]?></textarea><br>
            <input type=hidden name=exid value=<?php echo $exid ?>>
            <input type=hidden name=sid value=<?php echo $sid ?>>

            <?php if ($number != 0) : ?>
                <button type=submit name=currentquestion value=<?php echo ($number-1) ?>> Previous Question </button>
            <?php endif;?>
            <?php if($number < count($questions)-1) : ?>
                <button type=submit name=currentquestion value=<?php echo $number+1?>> Next Question </button>
            <?php endif ?>

            <br> <button type=submit name=identifier value=answer formaction="examlandingpage.php"> Submit Answers </button>
        </form>
    </div>
</body>
