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

      $urlActual =  $_SERVER['REQUEST_URI'] ?? '/';
      $metodo = $_SERVER['REQUEST_METHOD'];

      //Arreglo de rutas protegidas;
      // $rutas_protegidas = ['/dashboard'];

      $rutas_protegidas = [
         '/dashboard',
      ];

      $mi_url = explode('/', $urlActual);
      $mi_url_auth = '/' . $mi_url[1];

      if (in_array($mi_url_auth, $rutas_protegidas) && !$auth) {
         header('Location: /');
      }



      if ($metodo === 'GET') {
         $urlActual = explode('?', $urlActual)[0];
         $fn = $this->rutasGET[$urlActual] ?? null;
      } else {
         $urlActual = explode('?', $urlActual)[0];
         $fn = $this->rutasPOST[$urlActual] ?? null;
      }

      // if (in_array($urlActual, $rutas_protegidas) && !$auth) {
      //    redirect('/login');
      // }

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
      if (!file_exists(__DIR__ . '/views/' . $view . '.blade.php')) {
         echo "No existe la vista " . $view;
         exit;
      }

      $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
      

      $views = __DIR__ . '/views';


      $cache = __DIR__ . '/cache';

      $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);

      $blade->setAliasClasses(['Session'=>'Helpers\Session']);
      
      echo $blade->run($view, $datos);
      exit;
   }
}
