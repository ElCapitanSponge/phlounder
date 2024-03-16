<?php

namespace phlounder\lib;

/**
 * The supporter request types
 */
enum request_type{
    case GET;
    case POST;
    case PUT;
    case DELETE;
}
