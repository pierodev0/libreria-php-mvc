<?php

namespace Controllers;

use Helpers\Request;
use Model\Admin;
use MVC\Router;

class UserController
{

    public static function login(Router $router)
    {
        $errores = Admin::getErrores();
        if (Request::isMethod('post')) {
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if (empty($errores)) {

                //Veriicar que el usuario exista
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    //Verificar si el usuario existe (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        //Autenticar el usuario
                        $auth->autenticar();
                        redirect("/admin");
                    } else {
                        //Password incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        $router->render("auth/login", compact('errores'));
    }


    public static function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION = [];
        redirect('/');
    }
}
