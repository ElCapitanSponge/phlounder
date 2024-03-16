<?php

namespace phlounder;

use phlounder\lib\response;
use phlounder\lib\request_type;
use phlounder\router\parser;
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

        $splt_uri = explode("/", $_SERVER['REQUEST_URI']);
        $splt_route = explode("/", $route);

        if (count($splt_route) === count($splt_uri)) {
            $callback(
                new request(
                    parser::extract_parameters($splt_route, $splt_uri),
                    $method
                ),
                new response()
            );
        }
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

    /**
     * Add a POST route
     *
     * @param string $route The desired route
     * @param callable $callback The callback function
     */
    public function post(
        string $route,
        callable $callback
    ): void {
        $this->route_add(request_type::POST, $route, $callback);
    }

    /**
     * Add a PUT route
     *
     * @param string $route The desired route
     * @param callable $callback The callback function
     */
    public function put(
        string $route,
        callable $callback
    ): void {
        $this->route_add(request_type::PUT, $route, $callback);
    }

    /**
     * Add a DELETE route
     *
     * @param string $route The desired route
     * @param callable $callback The callback function
     */
    public function delete(
        string $route,
        callable $callback
    ): void {
        $this->route_add(request_type::DELETE, $route, $callback);
    }
}
