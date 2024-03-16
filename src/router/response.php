<?php

namespace phlounder\router;

use phlounder\lib\ErrorMessages;


/**
 * response handler
 */
class Response
{
    // TODO: Add HTMX response handling

    /**
     * The response message handler
     *
     * @var ErrorMessages
     */
    private static ErrorMessages $_msg;

    /**
     * Constructor for the response hander
     */
    public function __construct()
    {
        self::$_msg = new ErrorMessages();
    }

    /**
     * JSON response to return
     *
     * @param int $status The response code to return
     * @param \stdClass|string|null $data=null Data to return as part of the response if applicable
     */
    public function to_json(
        int $status,
        \stdClass|string|null $data = null
    ): void {
        http_response_code($status);
        header("Content-Type: application/json");
        $res = new response_payload();
        $res->code = $status;
        $res->message = self::$_msg->get($data->code);
        $res->data = $data;
        echo json_encode($res);
    }
}

/**
 * The response payload object for JSON responses
 */
class response_payload
{
    /**
     * Message for the response based on the response code
     *
     * @var string
     */
    public string $message;
    /**
     * The response code for the request
     *
     * @var int
     */
    public int $code;
    /**
     * Extra information that woul would like to return in the response. Defaults to NULL
     *
     * @var \stdClass|null
     */
    public \stdClass|null $data = null;
}
