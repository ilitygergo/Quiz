<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/gameControl.php');

?>

<table class="w3-table-all w3-hoverable">
    <tr>
        <th>Enemy</th>
        <th>When</th>
        <th>Category</th>
        <th>Hard</th>
    </tr>

    <?php
    $played = new Played($_SESSION['USERID']);
    $played->printChallenges();
    ?>
</table>

