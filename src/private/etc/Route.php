<?php

class Route {

    public static $validRoutes = [];

    public static function set($route, $function) {
        self::$validRoutes[] = $route;

        if (strpos($_SERVER['REQUEST_URI'], $route) !== false) {
            $function->__invoke();
        }


    }
}