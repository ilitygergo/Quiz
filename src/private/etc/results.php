<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Results.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Challenges.php');

if (isset($_SESSION["OFFSET"]) && isset($_SESSION["POINTS"]) && isset($_SESSION["CHALLENGEID"])) {
    $challenges = new Challenges();
    $results = new Results();

    $challenges->getChallange($_SESSION["CHALLENGEID"]);

    $results->setScore($_SESSION["POINTS"]);
    $results->setHard($challenges->getHard());
    $results->setTime(date("Y-m-d"));
    $results->setTopic($challenges->getTopic());
    $results->setUserID($_SESSION["USERID"]);

    $results->saveResults();

    unset($_SESSION['OFFSET']);
    unset($_SESSION['POINTS']);
    unset($_SESSION['CHALLENGEID']);
    unset($_SESSION['QUESTIONID']);
}
