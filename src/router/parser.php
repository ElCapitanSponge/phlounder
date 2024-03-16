<?php

namespace phlounder\router;

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
        // TODO: Implement the logic for the function
        return false;
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

                $value = $uri[$i];

                if (true === ctype_digit($value)) {
                    $value = (int)$value;
                }

                $pairs[$key] = $value;
            }
        }

        return $pairs;
    }
}
