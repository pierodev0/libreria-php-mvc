<?php

namespace MVC;

use eftec\bladeone\BladeOne;

class Router
{
   public $rutasGET = [];
   public $rutasPOST = [];
   public function __construct() {}

   public function get($url, $fn)
   {
      $this->rutasGET[$url] = $fn;
   }

   public function post($url, $fn)
   {
      $this->rutasPOST[$url] = $fn;
   }

   public function comprobarRutas()
   {
      if (!isset($_SESSION)) {
         session_start();
      }

      $auth = $_SESSION['login'] ?? false;

      //Arreglo de rutas protegidas;
      $rutas_protegidas = ['/admin'];

      $urlActual =  $_SERVER['REQUEST_URI'] ?? '/';
      $metodo = $_SERVER['REQUEST_METHOD'];

      if ($metodo === 'GET') {
         $urlActual = explode('?', $urlActual)[0];
         $fn = $this->rutasGET[$urlActual] ?? null;
      } else {
         $urlActual = explode('?', $urlActual)[0];
         $fn = $this->rutasPOST[$urlActual] ?? null;
      }

      if (in_array($urlActual, $rutas_protegidas) && !$auth) {
         redirect('/login');
      }

      if ($fn) {
         if (is_callable($fn)) {
            call_user_func($fn, $this);
         } else {
            echo "No existe el metodo " . $fn[1] . " en el controlador : " . $fn[0];
         }
      } else {
         redirect('/not-found');
      }
   }

   //Mostra una vista
   public function render($view = "", $datos = [])
   {
      $view = str_replace('/', DIRECTORY_SEPARATOR, $view);

      $views = __DIR__ . '/views';
      $cache = __DIR__ . '/cache';
      
      $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); 
      return $blade->run($view, $datos); 
   }
}
