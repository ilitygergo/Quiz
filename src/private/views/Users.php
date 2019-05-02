<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/etc/menu.php');
$users = new Users();

if(!isset($_GET['userid'])) {
    $users->printUsersTable();
} else {
    $id = $_GET['userid'];
    if($users->validUserId($id)){
        $users->printSpecificUserProfile($id);
    } else {
        header("Location: Users");
    }

}