<?php

require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Quiz/src/private/models/User.php');

$user = new User();

session_start();
if (isset($_SESSION["USERID"])) {
    $user->setUserID($_SESSION["USERID"]);
    $user->getUser($user->getUserID());
}

?>

<span id="mySidenav" class="sidenav">
    <span class="fas fa-brain fa-2x quizzy">Quizzy</span>
    <a href="index">Home</a>
    <a href="profile">Profile</a>
    <a href="friends">Friends</a>
    <a href="ranklist">Ranklist</a>
    <a href="played">Played</a>
</span>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <i class="fas fa-bars fa-2x" onclick="nyit()" style="cursor: pointer"></i>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link mb-0 h5" onclick="nyit()" style="cursor: pointer"><?php
                    if (strpos($_SERVER['REQUEST_URI'], 'index') !== false) {
                        echo 'Home';
                    } elseif (strpos($_SERVER['REQUEST_URI'], 'profile') !== false) {
                        echo 'Profile';
                    } elseif (strpos($_SERVER['REQUEST_URI'], 'friends') !== false) {
                        echo 'Friends';
                    } elseif (strpos($_SERVER['REQUEST_URI'], 'ranklist') !== false) {
                        echo 'Ranklist';
                    } elseif (strpos($_SERVER['REQUEST_URI'], 'played') !== false) {
                        echo 'Played';
                    }
                    ?> <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <button class="btn btn-light" type="submit" onclick="goto('profile')"><?=$user->getUserName()?></button>
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" onclick="goto('login')">Log Out</button>
    </div>
</nav>

<hr style="border-width: 0px;">

<script>
    function nyit() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function zar() {
        document.getElementById("mySidenav").style.width = "0";
    }

    function goto(url) {
        location.href = url;
    }

    document.body.addEventListener('click', function() {
        zar();
    }, true);
</script>
