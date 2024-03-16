<?php

namespace phlounder;

use phlounder\lib\request_type;

class router
{
    private static function run($method, $route, $callback)
    {
        return null;
    }

    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        return self::run($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        return self::run(request_type::POST, $route, $callback);
    }
    }
}
