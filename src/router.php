<?php

namespace phlounder;

use phlounder\lib\response;
use phlounder\lib\request_type;
use phlounder\router\request;

class router
{
    /**
     * Generic handler to run all routes
     *
     * @param string $method The method for the request
     * @param string $route The desired route
     * @param callable $callback The callback function
     */
    public function route_add(
        string $method,
        string $route,
        callable $callback
    ): void {
        $params = [];
        $callback(new request($method, $params), new response());
    }

    /**
     * Add a GET route
     *
     * @param string $route The desired route
     * @param callable $callback The callback function
     */
    public function get(
        string $route,
        callable $callback
    ): void {
        $this->route_add(request_type::GET, $route, $callback);
    }
}
