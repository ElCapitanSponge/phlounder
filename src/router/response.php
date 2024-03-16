<?php

namespace phlounder\lib;

/**
 * response handler
 */
class response
{
    // TODO: Add HTMX response handling

    /**
     * The response message handler
     *
     * @var response_message
     */
    private static response_message $_msg;

    /**
     * Constructor for the response hander
     */
    public function __construct()
    {
        self::$_msg = new response_message();
    }

    /**
     * JSON response to return
     *
     * @param int $status The response code to return
     * @param \stdClass|null $data=null Data to return as part of the response if applicable
     */
    public function to_json(
        int $status,
        \stdClass|null $data = null
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
