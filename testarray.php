<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title> We testing here</title>
    </head>
    <body>
        Hello man, we're doing some stuff.
        <?php
            $testarray = array("Answer1", "Answer2", "Answer3", "Answer4");
            $betweenarray = array($testarray, array("THis", "Is", "an", "Extra", "Array"));
	    $containerarray = array($betweenarray, $testarray);
            $target = "https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/debuglocal.php";
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, $target);
            curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($containerarray));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $return_val=curl_exec($ch);
            curl_close($ch);

            echo $return_val;
            echo "That we are friend";
            ?>
    </body>
</html>
