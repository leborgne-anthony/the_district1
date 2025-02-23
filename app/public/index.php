<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controller\HomeController;
use App\Controller\ContactController;

$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/contact', [ContactController::class, 'index']);
$router->post('/contact-submit', [ContactController::class, 'store']);
$router->dispatch();
?>
