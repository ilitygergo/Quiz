<?php

if (isset($_SESSION["OFFSET"]) && isset($_SESSION["POINTS"]) && isset($_SESSION["CHALLENGEID"])) {
    unset($_SESSION['OFFSET']);
    unset($_SESSION['POINTS']);
    unset($_SESSION['CHALLENGEID']);
    unset($_SESSION['QUESTIONID']);
}
