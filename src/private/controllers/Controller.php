<?php

class Controller extends Database {

    public static function view($viewName) {
        require_once("./private/etc/header.html");

        require_once("./private/views/$viewName.php");

        require_once("./private/etc/footer.html");
    }
}
