<?php

namespace Controllers;

use Helpers\Auth;
use Helpers\Hash;
use Helpers\Request;
use Model\Admin;
use Model\User;
use MVC\Router;

class UserController
{

    public static function login(Router $router)
    {
        $alertas = User::getAlertas();

        if (isMethod('POST')) {
            $auth = new User($_POST);
            $alertas = $auth->validar();

            if (empty($alertas)) {
                if (Auth::attempt(['email' => $auth->email, 'password' => $auth->password])) {
                     User::setAlerta("exito", "Paso la validacion");
                } else {
                    User::setAlerta("error", "Credenciales incorrectas");
                }
            }
        }
        $alertas = User::getAlertas();
        prettyPrint($alertas);
        echo $router->render("auth/login", compact('alertas'));
    }


    public static function crear(Router $router)
    {


        if (isMethod('post')) {
            $auth = new User($_POST);
            $auth->password = Hash::make($auth->password);
            $resultado = $auth->crear();
            if ($resultado) {
                redirect("/login");
            }
        }

        echo $router->render('auth/crear');
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
