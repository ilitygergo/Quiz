<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Questions.php');

session_start();
if (!isset($_SESSION["QUESTIONID"])) {
    header("Location: index");
}

$question = new Questions();
$question->getQuestions($_SESSION["QUESTIONID"][1]);

?>

<div class="w3-display-container w3-round-large" style="height:400px;  position: relative; z-index: 1;
    background: #FFFFFF;
    max-width: 500px;
    top: 150px;
    margin:30px auto 100px ;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
    <div class="w3-animate-top"> <h4><?=$question->getQuestion()?></h4></div>
    <hr/>
    <div <h1><?=$question->getTopic()?></h1></div>
    <table class="w3-display-middle" style="margin-top: 70px">
        <tr style="padding: 30px">
            <td><div id="ans1" class="w3-btn w3-round-xxlarge w3-amber" style="width: 200px"><?php echo $question->random()?></div></td>
            <td ><div id="ans2" class="w3-btn w3-round-xxlarge w3-amber" style="width: 200px"><?php echo $question->random()?></div></td>
        </tr>
        <tr>
            <td ><div id="ans3" class="w3-btn w3-round-xxlarge w3-amber" style="width: 200px"><?php echo $question->random()?></div></td>
            <td ><div id="ans4" class="w3-btn w3-round-xxlarge w3-amber" style="width: 200px"><?php echo $question->random()?></div></td>
        </tr>
    </table>

</div>
