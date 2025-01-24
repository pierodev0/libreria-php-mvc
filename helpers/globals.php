<?php
function asset($path)
{
  $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";  // Verifica si es HTTPS
  $baseUrl .= $_SERVER['HTTP_HOST'];  // Obtiene el dominio actual

  // Asegura que el path no tenga barra inicial
  $path = ltrim($path, '/');

  // Verifica si existe la carpeta `public`
  if (is_dir(__DIR__ . '/public')) {
    return $baseUrl . '/public/' . $path;
  } else {
    return $baseUrl . '/' . $path;  // En caso de que no haya carpeta 'public'
  }
}



if (!function_exists('public_path')) {
  /**
   * Get the path to the public directory.
   *
   * @param string $path
   * @return string
   */
  function public_path($path = '')
  {
    // Obtén la ruta base del proyecto
    $basePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public';

    // Normaliza el $path reemplazando '/' o '\' por DIRECTORY_SEPARATOR
    $normalizedPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

    // Devuelve la ruta base, con o sin un subdirectorio o archivo
    return $normalizedPath ? $basePath . DIRECTORY_SEPARATOR . ltrim($normalizedPath, DIRECTORY_SEPARATOR) : $basePath;
  }
}

function isMethod($method)
{
  $actualMehod = $_SERVER['REQUEST_METHOD'];
  return $actualMehod === strtoupper($method);
}



/**
 * Sanitizar el HTML
 * @param string $string Texto a sanitizar
 * @return string String sanitizado
 */
function s($string): string
{
  $stringSanitisado = htmlspecialchars($string);
  return $stringSanitisado;
}


// Imprime los arreglos mas bonitos
function prettyPrint($mensaje, $modo = 0)
{
  if ($modo == 0) {
    echo "<pre style='background-color: #000; color: #fff;'>";
    var_export($mensaje);
    echo "</pre>";
  } else {
    echo "<pre>";
    var_dump($mensaje);
    echo "</pre>";
  }


  //Imprimir array en la consola
  $object = json_encode($mensaje);
  print_r('<script>console.log(' . $object . ')</script>');
}

function dump($mensaje, $modo = 0)
{
  if ($modo == 0) {
    echo "<pre style='background-color: #000; color: #fff;'>";
    var_dump($mensaje);
    echo "</pre>";
    exit();
  } else {
    echo "<pre>";
    var_dump($mensaje);
    echo "</pre>";
    exit();
  }

  //Imprimir array en la consola
  $object = json_encode($mensaje);
  print_r('<script>console.log(' . $object . ')</script>');
}


function validarORedireccionar($parametro, $urlRedireccion): int
{
    // Validar si el parámetro existe y es un entero válido
    $id = filter_var($parametro, FILTER_VALIDATE_INT);
    
    if ($id === false) {
        // Redirigir si el ID no es válido
        header("Location: $urlRedireccion");
        exit;
    }

    return $id;
}

function redirect($url, $statusCode = 302) {
  //Todo: Check if existe in router
  if (!filter_var($url, FILTER_VALIDATE_URL) && !filter_var($url, FILTER_VALIDATE_DOMAIN)) {
      throw new InvalidArgumentException("The provided URL is not valid.");
  }

  // Set the HTTP status code
  http_response_code($statusCode);

  // Add the Location header for redirection
  header("Location: $url");

  // Stop further execution of the script
  exit();
}


ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__, 2)  . "/php_error_log");

