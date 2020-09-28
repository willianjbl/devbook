<?php
namespace core;

use \core\RouterBase;

class Router extends RouterBase {
    public $routes;

    public function get($endpoint, $trigger): void
    {
        $this->routes['get'][$endpoint] = $trigger;
    }

    public function post($endpoint, $trigger): void
    {
        $this->routes['post'][$endpoint] = $trigger;
    }

    public function put($endpoint, $trigger): void
    {
        $this->routes['put'][$endpoint] = $trigger;
    }

    public function delete($endpoint, $trigger): void
    {
        $this->routes['delete'][$endpoint] = $trigger;
    }

}
