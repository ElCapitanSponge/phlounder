<?php

namespace phlounder\router;

use phlounder\lib\request_type;

class request
{
    /**
     * List of paramater keys/values
     *
     * @var array<string|int>
     */
    private array $params;
    /**
     * The request type
     *
     * @var string
     */
    private string $method;

    /**
     * Constructor for the request class
     *
     * @param array<string|int> $params List of key value pairs from the route
     * @param string $method The method used for the route
     */
    public function __construct(array $params, string $method)
    {
        $this->params = $params;
        $this->method = $method;
    }

    /**
     * Get the body contents within the request
     *
     * @return array<string|int>|null
     */
    public function get_body(): array|null
    {
        if (
            request_type::POST !== $this->method &&
            request_type::PUT !== $this->method
        ) {
            return null;
        }

        $response = [];

        return $response;
    }

    /**
     * Get the JSON data within the payload
     *
     * @return \stdClass|null
     */
    public function get_json(): \stdClass|null
    {
        if (
            request_type::POST !== $this->method &&
            request_type::PUT !== $this->method
        ) {
            return null;
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content);

        return $decoded;
    }
}
