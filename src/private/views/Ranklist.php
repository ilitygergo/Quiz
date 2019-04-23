<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/Ranklist.php');

?>

<table class="w3-table-all w3-hoverable">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Points</th>
    </tr>
    <?php
        Ranklist::printRanklist();
    ?>
</table>
