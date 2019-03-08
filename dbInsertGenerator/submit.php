<?php
if (    isset($_POST['qu']) AND isset($_POST['ra']) AND isset($_POST['wa1']) AND
        isset($_POST['wa2']) AND isset($_POST['wa3'])   ) {

    $question = $_POST['qu'];
    $right_answer = $_POST['ra'];
    $wrong_answer1 = $_POST['wa1'];
    $wrong_answer2 = $_POST['wa2'];
    $wrong_answer3 = $_POST['wa3'];
    $hardness = $_POST['ha'];

    $output = fopen("insertLines.txt","a");

    $query_text = "INSERT INTO `Questions` VALUES (NULL, '$hardness', '$right_answer', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3', '$question');\n";
    fwrite($output,$query_text);
    fclose($output);
    header("Location: index.php?err=0");

} else {
    header("Location: index.php?err=1");
}