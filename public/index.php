<?php

use Controllers\HomeController;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\PropiedadController;
use Controllers\UserController;
use Controllers\VendedorController;
use eftec\bladeone\BladeOne;
use MVC\Router;

require_once __DIR__ . '/../includes/app.php';


$router = new Router();



//Login y autenticacion de usuarios
$router->get("/login",[UserController::class,'login']);
$router->post("/login",[UserController::class,'login']);

//Login y autenticacion de usuarios
$router->get("/crear",[UserController::class,'crear']);
$router->post("/crear",[UserController::class,'crear']);

$router->get("/logout",[UserController::class,'logout']);


//Pagina no encontrada
$router->get("/",[HomeController::class,'index']);
$router->get("/not-found",[HomeController::class,'notFound']);

$router->comprobarRutas();