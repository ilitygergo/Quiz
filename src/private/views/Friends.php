<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Friends.php');

?>

<table class="w3-table-all w3-hoverable pagetable">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Since</th>
    </tr>
    <tr>
        <td>TEMP</td>
        <td>TEMP</td>
        <td>1997.03.12</td>
    </tr>
    <?php
        $id = $_SESSION['USERID'];
        $friends = new Friends();
        $friends->printFriends($id);
    ?>


</table>
