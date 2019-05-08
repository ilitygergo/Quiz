<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Friends.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/gameControl.php');

?>

<table class="w3-table-all w3-hoverable pagetable">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Since</th>
        <th></th>
    </tr>
    <?php
        $id = $_SESSION['USERID'];
        $friends = new Friends();
        $friends->printFriends($id);
    ?>
</table>

<div class="modal fade" id="profile-modal">
    <div class="modal-dialog">
        <div class="modal-content">
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
        </div>
    </div>
</div>

<script>

    function Challenge(ID, username) {
        document.getElementById('modal-h4').innerHTML ="Challenge: " + username;
    }

</script>
