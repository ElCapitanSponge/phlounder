<?php

namespace phlounder\lib;

class response
{
    private static response_message $_msg;

    public function __construct()
    {
        self::$_msg = new response_message();
    }

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

class response_payload
{
    public string $message;
    public int $code;
    public \stdClass|null $data = null;
}
