<?php

namespace phlounder\lib;

/**
 * The supporter request types
 */
enum RequestType
{
    public const GET = "GET";
    public const POST = "POST";
    public const PUT = "PUT";
    public const DELETE = "DELETE";
    public const OPTIONS = "OPTIONS";
}
