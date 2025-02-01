<?php

namespace Controllers;

use Helpers\Auth;
use Helpers\Hash;
use Helpers\Session;
use Model\User;
use MVC\Router;

class UserController
{

    public static function login(Router $router)
    {
        $alertas = User::getAlertas();
        $auth = new User;

        if (isMethod('POST')) {
            $auth = new User($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                if (Auth::attempt(['email' => $auth->email, 'password' => $auth->password])) {
                    Session::set('login', true);
                    Session::set('email', $auth->email);
                    redirect('/dashboard');
                } else {
                    User::setAlerta("error", "Credenciales incorrectas");
                }
            }
        }
        $alertas = User::getAlertas();
        $router->render("auth/login", compact('alertas', 'auth'));
    }


    public static function register(Router $router)
    {

        $alertas = [];

        if (isMethod('post')) {
            $auth = new User($_POST);
            $validar = $auth->validarRegistro();

            if (empty($validar)) {

                if ($auth->existeEmail()) {
                    $alertas = User::getAlertas();
                    $router->render('auth/register', compact('alertas'));
                }

                $auth->password = Hash::make($auth->password);
                $resultado = $auth->guardar();

                if ($resultado) {
                    redirect('/login');
                }
            }
        }

        $alertas = User::getAlertas();
        $router->render('auth/register', compact('alertas'));
    }


    public static function logout()
    {
        Session::destroy();
        redirect('/');
    }
}
