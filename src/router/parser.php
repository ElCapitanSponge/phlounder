<?php

namespace phlounder\router;

use phlounder\lib\RequestType;

/**
 * parsing and processing of routes and their parameters
 */
class Parser
{
    /**
     * Check to see if the desired route matches with the uri
     *
     * @param array<string> $route The route being evaluated
     * @param array<string> $uri The uri being evaluated
     *
     * @return bool **true** if the uri matches the route. **false** if not
     */
    public static function match_route(array $route, array $uri): bool
    {
        if (count($route) !== count($uri)) {
            return false;
        }

        for ($i = 0; $i < count($route); $i++) {
            if (
                $route[$i] !== $uri[$i] &&
                "{" !== substr($route[$i], 0, 1)
            ) {
                return false;
            }

            if (
                $route[$i] !== $uri[$i] &&
                "{" === substr($route[$i], 0, 1)
            ) {
                // INFO: Checking ifroute param matches type if required
                $raw_key = str_replace("{", "", $route[$i]);
                $raw_key = str_replace("}", "", $raw_key);

                $tmp = explode(":", $raw_key);

                if (2 === count($tmp)) {
                    $type = $tmp[1];
                    if ("s" !== $type && "i" !== $type) {
                        return false;
                    }

                    if ("i" === $type && false === ctype_digit($uri[$i])) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    /**
     * Extract the route parameters from the specified route and match value
     *
     * @param array<string> $route The route being used
     * @param array<string> $uri The uri to be used
     *
     * @return array<string|int> Key/Value mapping of the request params
     */
    public static function extract_parameters(array $route, array $uri): array
    {
        $pairs = [];

        for ($i = 0; $i < count($route); $i++) {
            if ("{" === substr($route[$i], 0, 1)) {
                $key = str_replace("{", "", $route[$i]);
                $key = str_replace("}", "", $key);

                $tmp_key = explode(":", $key);

                $value = $uri[$i];

                if (true === ctype_digit($value)) {
                    $value = (int)$value;
                }

                $pairs[$tmp_key[0]] = $value;
            }
        }

        return $pairs;
    }

    /**
     * Check to see if the request method matches the desired method, or
     * the request is of type **OPTIONS**
     *
     * @param string $desired_method The wanted request method type
     * @param string $actual_method The actual method recieved by the server
     *
     * @return bool **true** if the desired and actual types match, or
     * **OPTIONS** is recieved. **false** otherwise
     */
    public static function method_check(
        string $desired_method,
        string $actual_method
    ): bool {
        if (RequestType::OPTIONS === $actual_method) {
            return true;
        }

        if ($desired_method === $actual_method) {
            return true;
        }

        return false;
    }
}
