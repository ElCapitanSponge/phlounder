<?php

foreach (glob("./src/**/*.php") as $filename) {
    include $filename;
}
foreach (glob("./src/*.php") as $filename) {
    include $filename;
}

// require __DIR__ . '/vendor/autoload.php';

use phlounder\Router;
use phlounder\lib\response_codes;
use phlounder\router\Request;
use phlounder\router\Response;

$router = new Router();

$router->get("/", function (Request $req, Response $res) {
    $res->to_json(response_codes::OK, "Hello World!");
});

$router->get("/user/{id}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(response_codes::OK, $data);
});

$router->none_found();
