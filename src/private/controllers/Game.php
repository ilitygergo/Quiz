<?php

class Game extends Controller {

    public function setOffsets() {
        session_start();
        if (!isset($_SESSION["QUESTIONID"])) {
            header("Location: index");
        }

        if (!isset($_SESSION["OFFSET"])) {
            $_SESSION["OFFSET"] = 0;
        }

        if (!isset($_SESSION["POINTS"])) {
            $_SESSION["POINTS"] = 0;
        }

        if($_SESSION["OFFSET"] == 10) {
            header("Location: index");
        }
    }

}
