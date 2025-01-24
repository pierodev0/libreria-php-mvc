<?php
namespace Helpers;
class Request
{
    private static $query;
    private static $request;
    private static $headers;
    private static $method;
    private static $input;
    private static $files;

    // Constructor ahora es privado y la clase es manejada estáticamente
    private function __construct()
    {
        self::$query = $_GET;
        self::$request = $_POST;
        self::$headers = self::getHeaders();
        self::$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        self::$files = $_FILES;
        self::$input = array_merge(self::$query, self::$request, self::parseBody());
    }

    // Método estático para inicializar los valores si aún no están inicializados
    public static function init()
    {
        if (self::$query === null) {
            new self();
        }
    }

    private static function getHeaders()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[$header] = $value;
            } elseif (in_array($key, ['CONTENT_TYPE', 'CONTENT_LENGTH'])) {
                $headers[str_replace('_', '-', $key)] = $value;
            }
        }
        return $headers;
    }

    private static function parseBody()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $body = file_get_contents('php://input');

        if (strpos($contentType, 'application/json') !== false) {
            return json_decode($body, true) ?? [];
        }

        if (in_array(self::$method, ['PUT', 'PATCH', 'DELETE'])) {
            parse_str($body, $parsed);
            return $parsed;
        }

        return [];
    }

    public static function input($key = null, $default = null)
    {
        self::init(); // Asegúrate de inicializar la clase
        if ($key === null) {
            return self::$input;
        }
        return self::$input[$key] ?? $default;
    }

    public static function query($key = null, $default = null)
    {
        self::init();
        if ($key === null) {
            return self::$query;
        }
        return self::$query[$key] ?? $default;
    }

    public static function header($key = null, $default = null)
    {
        self::init();
        if ($key === null) {
            return self::$headers;
        }
        return self::$headers[$key] ?? $default;
    }

    public static function method()
    {
        self::init();
        if (self::$method === 'POST' && self::input('_method')) {
            return strtoupper(self::input('_method'));
        }
        return self::$method;
    }

    public static function path()
    {
        self::init();
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        return $uri ?: '/';
    }

    public static function url()
    {
        self::init();
        return self::getScheme() . '://' . $_SERVER['HTTP_HOST'] . self::path();
    }

    public static function fullUrl()
    {
        self::init();
        return self::getScheme() . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public static function file($key)
    {
        self::init();
        return self::$files[$key] ?? null;
    }

    public static function bearerToken()
    {
        self::init();
        $header = self::header('Authorization');
        if (strpos($header, 'Bearer ') === 0) {
            return substr($header, 7);
        }
        return null;
    }

    public static function isXmlHttpRequest()
    {
        self::init();
        return self::header('X-Requested-With') === 'XMLHttpRequest';
    }

    private static function getScheme()
    {
        self::init();
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';
    }

    
    public static function isMethod($methods)
    {
        self::init();
        if (is_array($methods)) {
            return in_array(self::method(), $methods);
        }
        return self::method() === strtoupper($methods);
    }
}
