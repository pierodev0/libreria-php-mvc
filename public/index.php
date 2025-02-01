<?php

use Controllers\DashboardController;
use Controllers\HomeController;
use Controllers\UserController;
use MVC\Router;

require_once __DIR__ . '/../includes/app.php';


$router = new Router();



//Login y autenticacion de usuarios
$router->get("/login",[UserController::class,'login']);
$router->post("/login",[UserController::class,'login']);

//Login y autenticacion de usuarios
$router->get("/register",[UserController::class,'register']);
$router->post("/register",[UserController::class,'register']);
$router->get("/logout",[UserController::class,'logout']);

//Dashboard
$router->get("/dashboard",[DashboardController::class,'index']);


//Pagina no encontrada
$router->get("/",[HomeController::class,'index']);
$router->get("/not-found",[HomeController::class,'notFound']);

$router->comprobarRutas();