<?php

use eftec\bladeone\BladeOne;
use Model\ActiveRecord;

require __DIR__ . '/funciones.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/../helpers/globals.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la base de datos
$db = conectarDB();
ActiveRecord::setDB($db);


// function blade($view, $data = [])
// {
//     global $blade;
//     if ($blade === null) {
//         $view = str_replace('/', DIRECTORY_SEPARATOR, $view);

//         $views = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views';
//         $cache = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cache';

//         $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
//     }
//     return $blade->run($view, $data);
// }

