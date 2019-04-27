<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');

if (isset($_GET["history"]) || isset($_GET["geography"]) || isset($_GET["science"]) || isset($_GET["technology"]) || isset($_GET["literature"])) {
    $topics = [];
    $hardness = 0;
    $index = new Index();

    if(isset($_GET["history"])) {
        array_push($topics, 'history');
    }

    if(isset($_GET["geography"])) {
        array_push($topics, 'geography');
    }

    if(isset($_GET["science"])) {
        array_push($topics, 'science');
    }

    if(isset($_GET["technology"])) {
        array_push($topics, 'technology');
    }

    if(isset($_GET["literature"])) {
        array_push($topics, 'literature');
    }

    if(isset($_GET["hard"])) {
        $hardness = 1;
    }

    $topic =  $topics[array_rand($topics)];

    $index->createChallengeAndQuestionList($hardness, $topic, $_SESSION["USERID"]);
}

?>

<div class="w3-display-container w3-round-large" style="
    height:400px;
    position: relative;
    top: 150px;
    z-index: 1;
    background: #BFC0C0;
    max-width: 390px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
    <form class="game-form">
        <button class="btn btn-dark btn-lg">Quick Game</button>
        <table class="w3-display-middle w3-panel w3-round-large">
            <tr>
                <td id="themetd">History</td>
                <td id="themetd">
                    <label class="switch">
                        <input id="history" name="history" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </td>

                <td id="themetd">Geography</td>
                <td id="themetd">
                    <label class="switch">
                        <input id="geography" name="geography" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td id="themetd">Science</td>
                <td id="themetd">
                    <label class="switch">
                        <input id="science" name="science" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </td>

                <td id="themetd">Technology</td>
                <td id="themetd">
                    <label class="switch">
                        <input id="technology" name="technology" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
            <tr>
                <td id="themetd">Literature</td>
                <td id="themetd">
                    <label class="switch">
                        <input id="literature" name="literature" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>
                </td>

                <td id="themetd"><b>Hard</b></td>
                <td id="themetd">
                    <label class="switch">
                        <input id="hard" name="hard" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
        </table>
    </form>
</div>
