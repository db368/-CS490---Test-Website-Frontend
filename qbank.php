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
</style>

<head>
    <title> Qbank </title>
</head>

<body>
    <h1> Question Bank</h1>
    <p> Click on the question to edit it!</p>
    <div>
        <table style ="width:100%">
            <tr>
                <th> Question</th>
                <th> Difficulty </th>
            </tr>
            <!--Begin Table Fun -->
            <?php
            // Obtain Questions
            $target = "https://web.njit.edu/~jll25/CS490/switch.php";
            $ch= curl_init();
            curl_setopt($ch, CURLOPT_URL, "$target");
            curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('identifier'=>'v_testbank')));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $return_val=curl_exec($ch);
            curl_close($ch);
            if ($return_val == null) {
                echo "<h1> ERROR: NO RETURN VALUE </h1>";
                exit;
            }
            $questions = json_decode($return_val, true);
            echo '<form method="post" action="debug.php" class="inline">';
            echo '<input type="hidden" name="identifier" value="e_question">';

	    //Begin Printing Table
            foreach ($questions as $incoming){
                $qid = "error"; $qtext = "error"; $qdiff = "error";
                if (isset($incoming['Qid'])) { $qid = $incoming['Qid'];
                }
                if (isset($incoming['Question'])) { $qtext = $incoming['Question'];
                }
                if (isset($incoming["Difficulty"])) {$qdiff = $incoming['Difficulty'];
                }
                echo "<tr>";
                echo '<td> <button type="submit" name="qid" value="'. $qid .'" class="link-button"> '. $qtext. '</button></td>';
                echo '<td>'.$qdiff.'</td>';
                echo "</tr>";
            }
        ?>
        </form>
        </table>
    </div>
    <!--End the button Nonsense -->
    <div>
        <a href="addq.php"> Add a new question </a>
    </div>
</body>
</html>
