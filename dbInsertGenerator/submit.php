<?php
if (    isset($_POST['qu']) AND isset($_POST['ra']) AND isset($_POST['wa1']) AND
        isset($_POST['wa2']) AND isset($_POST['wa3']) AND isset($_POST['tp'])) {

    $question = $_POST['qu'] or null;
    $right_answer = $_POST['ra'] or null;
    $wrong_answer1 = $_POST['wa1'] or null;
    $wrong_answer2 = $_POST['wa2'] or null;
    $wrong_answer3 = $_POST['wa3'] or null;
    $topic = $_POST['tp'];
    $hardness = $_POST['ha'];

    if(     !empty($question) and !empty($right_answer) and !empty($wrong_answer1) and
            !empty($wrong_answer2) and !empty($wrong_answer3)   ){

        $output = fopen("insertLines.txt","a");

        $query_text = "INSERT INTO Questions VALUES (NULL, '$hardness', '$topic', '$right_answer', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$question');\n";
        fwrite($output,$query_text);
        fclose($output);

        header("Location: index.php?err=0");

    } else {
        header("Location: index.php?err=1");
    }



} else {
    header("Location: index.php?err=1");
}