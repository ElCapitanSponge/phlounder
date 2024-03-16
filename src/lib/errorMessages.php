<?php

namespace phlounder\lib;

/**
 * Messages for supported response codes
 */
class response_message
{
    /**
     * Get the error message for the associated response code
     *
     * @param int $code The response code
     *
     * @return string The message associated to the response code
     */
    public function get(int $code): string
    {
        switch ($code) {
            case response_codes::OK:
                return "OK";
            case response_codes::CREATED:
                return "Created successfully";
            case response_codes::NO_CONTENT:
                return "No content in response";
            case response_codes::FORBIDDEN:
                return "Unauthorised access";
            case response_codes::NOT_FOUND:
                return "Not Found";
            case response_codes::METHOD_NOT_ALLOWED:
                return "Invalid method used";
            case response_codes::GONE:
                return "Requested content no longer exists";
            case response_codes::TEAPOT:
                return "I'm a teapot";
            default:
                return "Unknown error";
        }
    }
}
