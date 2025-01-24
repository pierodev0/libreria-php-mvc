<?php
function conectarDB() : mysqli{
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'bienes_1';

    try {
        $db = new mysqli($host, $user, $pass, $db_name);
        return $db;
    } catch (mysqli_sql_exception $e) {
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        exit;
    }
    
}