<?php
// QBLOOPER: Sends out a request, then goes to target url.
//   ^S

switch($_POST['identifier']){
case "doesntmatter": //Used for edit button press. All handled by qbsplit
    break;

case "a_tc": //Increment the number of test cases
    $_POST['identifier'] = $_POST['subidentifier'];
    $_POST["numtc"]+=1;
    break;

default:
    //We're editing/adding a new question. Screen it for DB access
    $atc= array(); //Approved testcases
    $asoln = array();
    $stc = $_POST['testcase']; //Suspect test cases
    $ssoln = $_POST['solution'];
    for ($i = 0; $i<sizeof($stc); $i++){
        if ($stc[$i] != null and  $ssoln[$i] != null ) {
            $atc[$i] = $stc[$i];
            $asoln[$i] = $ssoln[$i];
        }
    }
    //Replace these with approved testcases/solutions
    $_POST["testcase"] = $atc;
    $_POST["solution"] = $asoln;


    //Now we curl
    $target = 'https://web.njit.edu/~jll25/CS490/switch.php';
    $ch= curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_POST, 1); // Set it to post
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $return_val=curl_exec($ch);
    $_POST=array('output'=> $return_val);
    break;

}
$_POST['id'] = (isset($_POST['qid'])) ? $_POST['qid'] : $_POST['id'];
$target = 'https://web.njit.edu/~db368/CS490_git/CS490-Test-Website-Frontend/frontend/qbank/addqsplit.php';
$ch= curl_init();
curl_setopt($ch, CURLOPT_URL, "$target");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$reload=curl_exec($ch);
curl_close($ch);

echo $reload;



?>
