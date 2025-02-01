<?php
namespace Helpers;
class Session {
    // Iniciar la sesión automáticamente si no está iniciada
    private static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Obtener un valor de la sesión
    public static function get($key, $default = null) {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    // Establecer un valor en la sesión
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Verificar si una clave existe en la sesión
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Eliminar un valor de la sesión
    public static function forget($key) {
        self::start();
        unset($_SESSION[$key]);
    }

    // Obtener todos los valores de la sesión
    public static function all() {
        self::start();
        return $_SESSION;
    }

    // Limpiar todas las variables de la sesión
    public static function destroy() {
        self::start();
        session_unset();
        session_destroy();
        $_SESSION = [];
    }
}

