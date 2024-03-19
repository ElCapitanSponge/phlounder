<?php

namespace phlounder;

use phlounder\lib\RequestType;
use phlounder\lib\ResponseCodes;
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
        // INFO: if the url ends with '/', remove the character
        $uri = $_SERVER["REQUEST_URI"];
        if ("/" === substr($uri, -1)) {
            $uri = rtrim($uri, "/");
        }

        $splt_uri = explode("/", $uri);
        $splt_route = explode("/", $route);

        if (
            true === Parser::method_check($method, $_SERVER["REQUEST_METHOD"]) &&
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

        $res->to_json(ResponseCodes::NOT_FOUND);
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
        $this->route_add(RequestType::GET, $route, $callback);
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
        $this->route_add(RequestType::POST, $route, $callback);
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
        $this->route_add(RequestType::PUT, $route, $callback);
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
        $this->route_add(RequestType::DELETE, $route, $callback);
    }
}
