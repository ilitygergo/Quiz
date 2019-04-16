<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.html');

?>

<div class="w3-display-container w3-round-large w3-green" style="
    height:400px;
    position: relative;
    top: 150px;
    z-index: 1;
    background: #FFFFFF;
    max-width: 390px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
    <button class="w3-btn w3-white w3-border w3-border-red w3-round-xlarge" onclick="game()"><a><strong>Quick Game</strong></a></button>
    <table class="w3-display-middle w3-panel w3-round-large w3-teal">
        <tr>
            <td id="themetd">History</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </td>

            <td id="themetd">Geography</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        <tr>
            <td id="themetd">Science</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </td>

            <td id="themetd">Technology</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>
        <tr>
            <td id="themetd" colspan="2">Literature</td>
            <td id="themetd">
                <label class="switch">
                    <input type="checkbox">
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
