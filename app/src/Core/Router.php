<?php
namespace App\Core;

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$url])) {
            $action = $this->routes[$method][$url];

            if (is_array($action)) {
                [$controller, $method] = $action;
                $controller = new $controller();
                $controller->$method();
            } else {
                call_user_func($action);
            }
        } else {
            http_response_code(404);
            echo "Page introuvable.";
        }
    }
}

?>
