<html>
<head>
    <title> Exam Question Add </title>
<style>

div.testbankquestions {
    float: right;
    overflow: auto;
    width: 50%;
    background-color: cyan;
    height:75%;
}
div.examquestions {
    float: left;
    overflow: auto;
    width: 50%;
    background-color: pink;
    height:75%;
}
</style>
</head>
<body>
    <div class="examquestions">
    <?php
        $examquestions = array(); //Time to pupulate this with dumb stuff
    for($i=0; $i<100; $i++){
        array_push($examquestions, 'Exam <i> '. bin2hex(random_bytes(rand(5,10)))) . '</i>';
    }
    foreach ($examquestions as $exam){
        echo $exam . "<br>";
    }
?>
    </div>

    <div class="testbankquestions">
        How does this look?
    </div>
</body>
</html>
