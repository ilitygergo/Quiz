<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Friends.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/gameControl.php');

$index = new Index();
$friends = new Friends();

if (isset($_SESSION['USERID'])) {
    $id = $_SESSION['USERID'];
}

if (isset($_POST['delete'])) {
    $friends->deleteFriend($_POST['delete'], $_SESSION['USERID']);
}

if (isset($_GET["history"]) || isset($_GET["geography"]) || isset($_GET["science"]) || isset($_GET["technology"]) || isset($_GET["literature"])) {
    $topics = [];
    $hardness = 0;
    $challenged = 0;

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

    $index->createChallenge($hardness, $topic, $_SESSION["USERID"], $challenged);
}

?>

<table class="w3-table-all w3-hoverable pagetable">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Since</th>
        <th></th>
        <th></th>
    </tr>
    <?php
        $friends->printFriends($id);
    ?>
</table>

<div class="modal fade" id="profile-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="game-form">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-h4">
                    </h4>
                    <button class="btn btn-dark btn-lg">Quick Game</button>
                </div>
                <div class="modal-body">
                    <div id="content">
                        <table align="center">
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
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function Challenge(ID, username) {
        document.getElementById('modal-h4').innerHTML ="Challenge: " + username;
    }

</script>
