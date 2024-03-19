# PHlounder

Minimalistic opinionated PHP Routing engine

[![PHP](https://img.shields.io/badge/PHP%208.3+-purple.svg?style=for-the-badge&logo=php)](https://www.php.net)

## ⇁ About

A minimalistic routing engine for PHP allowing route parameters for GET, POST,
PUT, DELETE and OPTIONS. The only thing missing is __your code__.

## ⇁ Installation

### Composer

```SHELL
composer require elcapitansponge/phlounder
```

### Git

__NOTE__ As this is still in development cloning the repo is the way to go.

```SHELL
git clone https://github.com/ElCapitanSponge/phlounder.git
```

or

```SHELL
git clone git@github.com:ElCapitanSponge/phlounder.git
```

## ⇁ Getting Started

### Calling the library

Include the library in your script

#### Composer

```PHP
require __DIR__ . "/vendor/autoload.php"
```

#### Git Clone

Alternitively you can load the files using the following snippet

```PHP
$phlounder_path = "./phlounder/";

foreach (glob("{$phlounder_path}src/**/*.php") as $filename) {
    include $filename;
}
foreach (glob("{$phlounder_path}src/*.php") as $filename) {
    include $filename;
}
```

### Using the library

An example implementation of phlounder is as follows

```PHP
use phlounder\Router;
use phlounder\lib\ResponseCodes;
use phlounder\router\Request;
use phlounder\router\Response;

$router = new Router();

$router->get("/", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::OK, "Hello World!");
});

$router->get("/user/{id}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});

$router->post("/user", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::CREATED);
});

$router->put("/user/{id}", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::OK);
});

$router->delete("/user/{id}", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::OK);
});

$router->none_found();
```

### Route Handling

The routing due to the nature of implementation follows the order of precidence.
In otherwords, a top to bottom approach when processing.

This is apparent with the following snippet:

```PHP
$router->get("/user/{id}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});

$router->get("/user/foo", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::OK, "Bar!");
});
```

In the above snippet if you hit ``/user/foo``
You don't recieve:

```JSON
{
    "code": 200,
    "data": "Bar!"
}
```

Instead you recieve:

```JSON
{
    "code": 200,
    "data": {
        "params": {
            "id": "foo"
        }
    }
}
```

To resolve this issue we have to place the ``/user/foo`` route before ``/user/{id}``

```PHP
$router->get("/user/foo", function (Request $req, Response $res) {
    $res->to_json(ResponseCodes::OK, "Bar!");
});

$router->get("/user/{id}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});
```

### Route paramater types

There is type handling for ``string`` or ``int`` in the route params if desired.

Taking the following:

```PHP
$router->get("/users/{id:i}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});

$router->get("/course/{code:s}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});

$router->get("/category/{id}", function (Request $req, Response $res) {
    $data = new \stdClass();
    $data->params = $req->get_params();
    $res->to_json(ResponseCodes::OK, $data);
});
```

- ``/users/{id:i}``: The ``id`` param is specified to be an ``int``
- ``/course/{code:s}``: The ``code`` param is specified to be a ``string``
- ``/category/{id}``: The ``id`` param can be either a ``string`` or an ``int``
