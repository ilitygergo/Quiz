<?php

session_start();
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');

if(isset($_SESSION['USERID'])){
    $user = new User();
    $user->getUser($_SESSION['USERID']);
    if($user->getIsAdmin()){
        if(array_key_exists('userid',$_POST)){
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/controllers/AdminPanel.php');
            $admin = new AdminPanel();
            $admin->deleteUser($_POST['userid']);
            header("Location: AdminPanel?delSuccess=1");
        } else {
            header("Location: index");
        }
    } else {
        header("Location: index");
    }
} else {
    header("Location: index");
}