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
<div class="w3-display-container w3-round-large w3-green" style="height: 500px;  position: relative; z-index: 1;
    background: #FFFFFF;
    max-width: 400px;
    margin:30px auto 100px ;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
    <img class="w3-display-topmiddle w3-circle" src="img/gandalf.jpg" width="100" style="margin-top: 10px">
    <table class="w3-display-topmiddle w3-teal w3-round-large" style="margin-top:120px">
        <tr>
            <td >Firstname:</td>
            <td style="width: 170px">Gandalf</td>
        </tr>
        <tr>
            <td >Lastname:</td>
            <td style="width: 170px">the White</td>
        </tr>
        <tr>
            <td>Ranklist:</td>
            <td>1001231.</td>
        </tr>
        <tr>
            <td>
                Score:
            </td>
            <td>554564</td>
        </tr>
        <tr>
            <td>
                Title:
            </td>
            <td>
                Wizard
            </td>
        </tr>
        <tr>
            <td>
                Birthday:
            </td>
            <td>
                Nobody knows
            </td>
        </tr>
        <tr>
            <td>
                Gender:
            </td>
            <td>
                Male
            </td>
        </tr>
        <tr>
            <td colspan="2"><button>My Stat</button></td>
        </tr>
        <tr>
            <td colspan="2"><button>Edit</button></td>
        </tr>
    </table>

</div>
