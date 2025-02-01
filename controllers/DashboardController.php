<?php
namespace Controllers;

use Helpers\Session;
use MVC\Router;

class DashboardController
{
    public static function index(Router $router)
    {
        $router->render("dashboard/index");
    }
}