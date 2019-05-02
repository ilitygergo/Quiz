<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/Questions.php');

$game = new Game();
$game->setOffsets();

$question = new Questions();
$question->getQuestions($_SESSION["QUESTIONID"][$_SESSION["OFFSET"]]);

$ans1 =  $question->random();
$ans2 =  $question->random();
$ans3 =  $question->random();
$ans4 =  $question->random();

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
<div><h1 id="message-box"></h1><b></b></div>
    <table class="w3-display-middle" style="margin-top: 70px">
        <tr style="padding: 30px">
            <td><div id="ans1" class="w3-btn w3-round-xxlarge w3-amber" onclick="getAnswer('ans1')" style="width: 200px"><?php echo $ans1 ?></div></td>
            <td ><div id="ans2" class="w3-btn w3-round-xxlarge w3-amber" onclick="getAnswer('ans2')" style="width: 200px"><?php echo $ans2 ?></div></td>
        </tr>
        <tr>
            <td ><div id="ans3" class="w3-btn w3-round-xxlarge w3-amber" onclick="getAnswer('ans3')" style="width: 200px"><?php echo $ans3 ?></div></td>
            <td ><div id="ans4" class="w3-btn w3-round-xxlarge w3-amber" onclick="getAnswer('ans4')" style="width: 200px"><?php echo $ans4 ?></div></td>
        </tr>
    </table>

</div>

<script>

    function getAnswer(ans) {
        var answer = null;

        switch(ans) {
            case 'ans1':
                answer = $(ans1).context.innerHTML;
                break;
            case 'ans2':
                answer = $(ans2).context.innerHTML;
                break;
            case 'ans3':
                answer = $(ans3).context.innerHTML;
                break;
            case 'ans4':
                answer = $(ans4).context.innerHTML;
                break;
        }

        $.post(
            'private/etc/nextQuestion.php',
            {
                answer: answer
            },
            function(data) {

                $('#message-box').text(data);

                setTimeout(function(){ location.reload(); }, 2000);
            }
        );
    }

</script>
