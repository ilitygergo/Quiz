<?php

?>

<span id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="zar()">×</a>
    <a href="profil.html">Porlife</a>
    <a href="friends.html">Freidns</a>
    <a href="ranklist.html">Rnkalits</a>
    <a href="mygames.html">My Games</a>
    <a href="index.html">Log Out</a>
</span>
<table>
    <tr>
        <td width="500px">
            <span style="font-size:30px;cursor:pointer;color: #EF3B3A" onclick="nyit()">Menu</span>
        </td>
        <td >
            <span id="ez" class="w3-display-topmiddle">Quizzy</span>
        </td>
    </tr>
</table>
<script>
    function nyit() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function zar() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<hr class="w3-deep-orange">

<div class="w3-display-container w3-round-large w3-green" style="height:400px;  position: relative; z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
    <button class="button; w3-display-topmiddle" style="margin-top:30px; text-align: center; width: 200px; height: 50px; font-size: x-large; "><strong>Gyorsjáték</strong></button>
    <table class="w3-display-middle w3-panel w3-round-large w3-teal">
        <tr>
            <td id="themetd" class="">Téma1</td>
            <td id="themetd"><input type="checkbox"></td>
            <td id="themetd">Téma2</td>
            <td id="themetd"><input type="checkbox"></td>
        </tr>
        <tr>
            <td id="themetd">Téma3</td>
            <td id="themetd"><input type="checkbox"></td>
            <td id="themetd">Téma4</td>
            <td id="themetd"><input type="checkbox"></td>
        </tr>
        <tr>
            <td id="themetd" colspan="2">Téma5</td>
            <td id="themetd"><input type="checkbox"></td>
        </tr>
    </table>
</div>
