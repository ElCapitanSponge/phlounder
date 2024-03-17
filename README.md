# PHlounder

Minimalistic opinionated PHP Routing engine

[![PHP](https://img.shields.io/badge/PHP%208.3+-purple.svg?style=for-the-badge&logo=php)](https://www.php.net)

## ⇁ About

A minimalistic routing engine for PHP allowing route parameters for GET, POST,
PUT and DELETE. The only thing missing is __your code__.

## ⇁ Installation

__NOTE__ As this is still in development cloning the repo is the way to go.

```SHELL
git clone https://github.com/ElCapitanSponge/phlounder.git
```

or

```SHELL
git clone git@github.com:ElCapitanSponge/phlounder.git
```

### To be implemented

- [ ] composer
- [ ] npm

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

$router->post("/user", function (Request $req, Response $res) {
    $res->to_json(response_codes::CREATED);
});

$router->put("/user/{id}", function (Request $req, Response $res) {
    $res->to_json(response_codes::OK);
});

$router->delete("/user/{id}", function (Request $req, Response $res) {
    $res->to_json(response_codes::OK);
});

$router->none_found();
```

## ⇁ Outstanding Tasks

- [ ] Add to composer
- [ ] Add to NPM
- [ ] Implement HEADER handling
- [ ] Implement auth handlers for the HEADER
  - [ ] Bearer token handling
  - [ ] PHP Session ID handling
  - [ ] JWT Handling
- [ ] Add **authorised required** option to routes
