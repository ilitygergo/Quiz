<?php

require_once('Routes.php');

function __autoload($class_name) {
    if (file_exists('./private/etc/'.$class_name.'.php')) {
        require_once './private/etc/'.$class_name.'.php';
    } elseif (file_exists('./private/controllers/'.$class_name.'.php')) {
        require_once './private/controllers/'.$class_name.'.php';
    }
}
