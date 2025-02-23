<?php
namespace App\Controller;

use App\Core\View;

class HomeController
{
    public function index()
    {
        return View::render("home");
    }
}
?>
