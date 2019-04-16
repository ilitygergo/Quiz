<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.html');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');

$user = new User();

session_start();
if (isset($_SESSION["USERID"])) {
    $user->setUserID($_SESSION["USERID"]);
    $user->getUser($user->getUserID());
}

?>

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
            <td >Username:</td>
            <td style="width: 170px"><?=$user->getUserName()?></td>
        </tr>

        <tr>
            <td >Firstname:</td>
            <td style="width: 170px"><?=$user->getFirstName()?></td>
        </tr>

        <tr>
            <td >Lastname:</td>
            <td style="width: 170px"><?=$user->getLastName()?></td>
        </tr>

        <tr>
            <td>Ranklist:</td>
            <td>1001231.</td>
        </tr>

        <tr>
            <td>Score:</td>
            <td>554564</td>
        </tr>

        <tr>
            <td>Birthday:</td>
            <td><?=$user->getBirthday()?></td>
        </tr>

        <tr>
            <td>Gender:</td>
            <td><?=$user->getGender()?></td>
        </tr>

        <tr>
            <td colspan="2"><button>My Stat</button></td>
        </tr>

        <tr>
            <td colspan="2"><button>Edit</button></td>
        </tr>
    </table>

</div>
