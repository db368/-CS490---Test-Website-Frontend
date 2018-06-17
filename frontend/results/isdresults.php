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
good{
    text-ccolor:rgb(0,255,0);
}
bad{
    color:rgb(255,0,0);
    text-decoration:line-through;
}

</style>
<head>
    <title> Results </title>
    <link rel="stylesheet" href="../styles.css">

</head>
<body>

    <header> <h1> Results for Student <?php echo isset($_POST['eid']) ? $_POST['eid'] : "Test User?";?> </h1></header>
    <div>

    <?php
    $debug = 1; // Enables the debug boxes
    $testdata = 0; //Enables the use of live data

    $eid = ((isset($_POST['eid']))) ? $_POST['eid'] : 39;
    $sid = ((isset($_POST['sid']))) ? $_POST['sid'] : 39;

    $_POST['identifier'] = 's_results';

    if (!$testdata) {
        $target = "https://web.njit.edu/~jll25/CS490/switch.php";
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, "$target");
        curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'s_results', 'eid'=> $eid, 'sid' => $sid)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $return_val=curl_exec($ch);

        $results = json_decode($return_val, true);

        ?>
        <?php if ($debug) : ?>
            <h2> POST INPUT </h2>
            <div class='debug'>
                <?php echo ($_POST != null) ? print_r($_POST) : "No Post!"; ?>
            </div>
            <h2> JSON OUTPUT </h2>
            <div class='debug'>
                <?php echo ($return_val == null) ? "No Return Value!" : $return_val  ?>
            </div><br>
            <?php if ($return_val == null) : ?>
                 <h2> ERROR: ANSWERS COULD NOT BE RETRIEVED, USING TEST DATA </h2>
                <?php $testdata = rand(10, 50);
            endif;
        endif;
    }

    if ($testdata) { //Generate our own joke data
        $results = array();
        for ($i=0; $i<$testdata; $i++){
            //Generate some nonsense
            $max = rand(5, 39);
            $score = rand(0, $max);
            $text=rand(100000, 99999999);
            $answer = rand(100000, 99999999);

            $tests = array();
            $outputs = array();
            $sols = array();
            $tcr = rand(1, 5);
            for ($k=0; $k<$tcr; $k++){
                array_push($tests, "( ". rand(100000, 99999999) ."," . rand(100000, 99999999) . "," . rand(100000, 99999999) .")");
                array_push($sols, rand(1, 10));
                array_push($outputs, rand(1, 10));

            }

            $result = array(
                'maxscore' => $max,
                'score' => $score,
                'Question' => $text,
                'Answer' => $answer,
                'testcase' => $tests,
                'solution' => $sols,
                'output' => $outputs,
                'qid' => rand(1, 100)
            );
            array_push($results, $result);
        }
        //Just for fun, lets do a little student simulator
        $int = rand(0, 6); // a value for every type of letter grade A B C D E F
        foreach($results as $result){
            if (rand(0, 7) > $int) { $result['solution'] = $result['output'];
            }
        }
    }
    ?>

    <table>
        <tr> <th> Question </th> <th> Answer </th> <th> Testcase Results </th> <th> Comment </th> </tr>
        <?php
        foreach($results as $question){
            // First lets get our variables sorted out
            $maxscore = ((isset($question['Total_points']))) ? $question['Total_points'] : "39";
            $qid = ((isset($question['Qid']))) ? $question['Qid'] : "??";
            $score = ((isset($question['score']))) ? $question['score'] : "39";
            $qtext = ((isset($question['Question']))) ? $question['Question'] : "How could this happen?!?!?";
            $answer = ((isset($question['Answer']))) ? $question['Answer'] : "print('there's a bug?')";

            $testcases = ((isset($question['TestCase']))) ? $question['TestCase'] : array("I didn't", "read this", "correctly");
            $solutions = ((isset($question['solution']))) ? $question['solution'] : array("This didn't", "happen like", "I expected");
            $output = ((isset($question['output']))) ? $question['output'] : array("Fix", "This", "Bug");

            $tcnum = sizeof($testcases);
            ?>
            <tr>
                <td>
                    <?php echo $qtext; ?> </td>
                <td>
                    <?php echo $answer; ?> </td>

                <td>
                    <table>
                        <tr>
                            <th class="small"> TESTCASE </th>
                            <th class="small"> RESULT </th>
                            <th class="small"> SOLUTION </th>
                        </tr>
                        <?php for ($i=0; $i<$tcnum; $i++): ?>
                        <tr>
                            <td>
                                Testcase
                                <?php echo $i; ?> :
                                <?php echo $testcases[$i]; ?>
                            </td>
                            <td>
                                <?php echo $output[$i]; ?>
                            </td>
                            <td>
                                <?php echo $solutions[$i]; ?>
                            </td>
                        </tr>
                        <?php endfor ?>
                    </table>
                    <form method="post" action="../debug.php">
                        <td>
                            <h3> SCORE: <?php echo $score; ?> / <?php echo $maxscore; ?> </h3><br>
                            <input type=hidden name=qid value=<?php echo $qid; ?>
                           Edit <input type=number max=<?php echo $maxscore; ?>
                            <?php echo $score ?> min=0 name=newscore> <br> Comment <textarea name="comment"> </textarea><br>
                            <button type=submit> Submit Changes </button>
                        </td>
                    </form>
            </tr>            <?php
        }
        ?>
    </table>
</body>
</html>
