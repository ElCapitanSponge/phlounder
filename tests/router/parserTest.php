<?php

$phlounder_path = __DIR__ . "/../../";

foreach (glob("{$phlounder_path}src/**/*.php") as $filename) {
    include $filename;
}
foreach (glob("{$phlounder_path}src/*.php") as $filename) {
    include $filename;
}

use PHPUnit\Framework\TestCase;
use phlounder\lib\RequestType;
use phlounder\router\Parser;

final class ParserTest extends TestCase
{
    public function test_match_route(): void
    {
        $test_route = "/users/{id}/edit";
        $test_uri = "/users/42069/edit";

        $result = Parser::match_route(
            explode("/", $test_route),
            explode("/", $test_uri)
        );

        $this->assertTrue($result);

        $test_route = "/users/{id}/edit";
        $test_uri = "/users/42069";

        $result = Parser::match_route(
            explode("/", $test_route),
            explode("/", $test_uri)
        );

        $this->assertFalse($result);
    }

    public function test_extract_parameters(): void
    {
        $test_route = "/blogs/{category}/posts/{id}";
        $test_uri = "/blogs/tech/posts/42069";

        $expected_result = [
            "category" => "tech",
            "id" => 42069
        ];

        $result = Parser::extract_parameters(
            explode("/", $test_route),
            explode("/", $test_uri)
        );


        $this->assertSame($result, $expected_result);
    }

    public function test_method_check(): void
    {
        $desired = RequestType::GET;
        $actual = RequestType::OPTIONS;

        $result = Parser::method_check($desired, $actual);
        $this->assertTrue($result);

        $actual = RequestType::GET;

        $result = Parser::method_check($desired, $actual);
        $this->assertTrue($result);

        $actual = RequestType::POST;

        $result = Parser::method_check($desired, $actual);
        $this->assertFalse($result);
    }
}
