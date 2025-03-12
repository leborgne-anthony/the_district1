<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . "/../views/" . str_replace('.', '/', $view) . ".php";

        if (self::isValidView($viewPath)) {
            extract($data);

            require $viewPath;
        } else {
            http_response_code(404);
            echo "View not found!";
            exit();
        }
    }

    private static function isValidView(string $viewPath): bool
    {
        return file_exists($viewPath) && strpos(realpath($viewPath), realpath(__DIR__ . "/../views")) === 0;
    }
}
