<?php

if(isset($_GET['user1']) and isset($_GET['user2'])){
    $users = new Users();
    $users->addFriend($_GET['user1'],$_GET['user2']);
    header("Location: Users?userid=".$_GET['user2']."");
} else {
    header("Location: index");
}


