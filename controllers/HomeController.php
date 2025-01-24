<?php

namespace Controllers;

use MVC\Router;

class HomeController
{
    public static function index(Router $router)
    {
        $name = 'Miguel';
        echo $router->render("home/index", compact('name'));
    }


    public static function notFound(Router $router)
    {
        echo $router->render("404");
    }
}
