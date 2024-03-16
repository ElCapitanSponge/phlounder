<?php

namespace phlounder\lib;

/**
 * Available response code types.
 *
 * For reference look at the [mdn docs](https://developer.mozilla.org/en-US/docs/WEB/HTTP/Status)
 */
enum response_codes
{
    public const OK = 200;
    public const CREATED = 201;
    public const NO_CONTENT = 204;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const GONE = 410;
    public const TEAPOT = 418;
}
