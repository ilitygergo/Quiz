<?php

session_start();

$q = $_POST['qu'] ?? null;      // QUESTION
$r = $_POST['ra'] ?? null;      // RIGHT ANSWER
$w1 = $_POST['wa1'] ?? null;    // WRONG ANSWER 1
$w2 = $_POST['wa2'] ?? null;    // WRONG ANSWER 2
$w3 = $_POST['wa3'] ?? null;    // WRONG ANSWER 3
$t = $_POST['tp'] ?? null;      // TOPIC
$d = $_POST['ha'] ?? 0;      // DIFFICULTY 1= HARD 0= EASY

if(
    !empty($q) && !empty($r) && !empty($w1) && !empty($w2) &&
    !empty($w3) && !empty($t)
){
    $adminPanel = new AdminPanel();
    $adminPanel->addQuestion($d,$t,$r,$w1,$w2,$w3,$q);
    header("Location: AdminPanel");
}

