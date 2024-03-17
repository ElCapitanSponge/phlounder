<?php

namespace phlounder\lib;

/**
 * Messages for supported response codes
 */
class ErrorMessages
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
            case ResponseCodes::OK:
                return "OK";
            case ResponseCodes::CREATED:
                return "Created successfully";
            case ResponseCodes::NO_CONTENT:
                return "No content in response";
            case ResponseCodes::FORBIDDEN:
                return "Unauthorised access";
            case ResponseCodes::NOT_FOUND:
                return "Not Found";
            case ResponseCodes::METHOD_NOT_ALLOWED:
                return "Invalid method used";
            case ResponseCodes::GONE:
                return "Requested content no longer exists";
            case ResponseCodes::TEAPOT:
                return "I'm a teapot";
            default:
                return "Unknown error";
        }
    }
}
