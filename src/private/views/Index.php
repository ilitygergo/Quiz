<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');

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
    <button type="button" class="btn btn-info btn-lg" onclick="game()">Quick Game</button>
    <table class="w3-display-middle w3-panel w3-round-large">
        <tr>
            <td id="themetd">History</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </td>

            <td id="themetd">Geography</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        <tr>
            <td id="themetd">Science</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </td>

            <td id="themetd">Technology</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        <tr>
            <td id="themetd" colspan="2">Literature</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
    </table>
</div>

<script>
    function game() {
        location.href = 'game';
    }
</script>
