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
