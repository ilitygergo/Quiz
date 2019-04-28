<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Questions.php');

session_start();
$question = new Questions();
$question->getQuestions($_SESSION["QUESTIONID"][$_SESSION["OFFSET"]]);

if(isset($_POST['answer']) && !empty($_POST['answer'])) {
    if ($_POST['answer'] === $question->getCorrect()) {
        if($question->getHard() === 1) {
            $_SESSION["POINTS"] += 2;
        } else {
            $_SESSION["POINTS"] += 1;
        }
    }

    $_SESSION["OFFSET"] += 1;
}
