<?php

namespace phlounder;

use phlounder\lib\request_type;
use phlounder\lib\response_codes;
use phlounder\router\Parser;
use phlounder\router\Request;
use phlounder\router\Response;

/**
 * Router for phlounder
 */
class Router
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

        if (
            $_SERVER["REQUEST_METHOD"] === $method &&
            true === Parser::match_route($splt_route, $splt_uri)
        ) {
            $callback(
                new Request(
                    Parser::extract_parameters($splt_route, $splt_uri),
                    $method
                ),
                new Response()
            );
        }
    }

    /**
     * Default handler to use at the end if nonoe of the previous routes trigger
     */
    public function none_found(): void
    {
        $res = new Response();

        $res->to_json(response_codes::NOT_FOUND);
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
