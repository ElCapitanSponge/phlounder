<?php

namespace phlounder\router;

/**
 * parsing and processing of routes and their parameters
 */
class parser
{
    /**
     * Extract the route parameters from the specified route and match value
     *
     * @param string $route The route being used
     *
     * @return array<string|int> Key/Value mapping of the request params
     */
    public static function extract_parameters(string $route): array
    {
        $splt_uri = explode("/", $_SERVER['REQUEST_URI']);
        $splt_route = explode("/", $route);

        if (count($splt_route) !== count($splt_uri)) {
            return [];
        }

        $pairs = [];

        for ($i = 0; $i < count($splt_route); $i++) {
            if ("{" === substr($splt_route[$i], 0, 1)) {
                $key = str_replace("{", "", $splt_route[$i]);
                $key = str_replace("}", "", $key);

                $value = $splt_uri[$i];

                if (true === ctype_digit($value)) {
                    $value = (int)$value;
                }

                $pairs[$key] = $value;
            }
        }

        return $pairs;
    }
}
