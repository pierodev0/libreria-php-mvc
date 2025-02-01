<?php

namespace Model;

class ActiveRecord
{
    //Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Alertas y Mensajes
    protected static $alertas = [];

    //Definir la conexion a la base de datos
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function setAlerta($tipo = "error", $mensaje )
    {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas()
    {
        return static::$alertas;
    }


    public function guardar()
    {
        if (!empty($this->id)) {
            //Actualizar
            return $this->actualizar();
        } else {
            return $this->crear();
        }
    }

    public function crear()
    {

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $columns = join(", ", array_keys($atributos));
        $values = join("', '", array_values($atributos));

        $query = "INSERT INTO " . static::$tabla . " ({$columns}) VALUES ('{$values}')";

        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar()
    {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();


        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $campos = join(", ", $valores);


        $id = self::$db->escape_string($this->id);
        $query = "UPDATE " . static::$tabla . " SET $campos WHERE id = $id LIMIT 1";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            /* Ignorar id */
            if ($columna == "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->real_escape_string($value);
        }
        return $sanitizado;
    }

    


    public function validar()
    {
        static::$alertas = [];
        return static::$alertas;
    }

    public function setImagen($imagen)
    {
        //Eliminar imagen anterior
        if (!empty($this->id)) {
            $this->borrarImagen();
        }

        //Asignar el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function borrarImagen()
    {
        $fileExist = file_exists(public_path("img/") . $this->imagen);
        if ($fileExist) {
            unlink(public_path("img/") . $this->imagen);
        }
    }

    //Listar todas las registros
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }


    public static function get($limit)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limit}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function find($id)
    {
        $id = self::$db->escape_string($id);
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function rawSQl($query)
    {
        $resultado = self::consultarSQL($query);

        if (count($resultado) == 1) {
            return array_shift($resultado);
        } else {
            return $resultado;
        }
    }

    public static function where($column, $value)
    {
        $tabla = static::$tabla;

        $column = self::$db->escape_string($column);
        $value = self::$db->escape_string($value);

        $query = "SELECT * FROM {$tabla} WHERE {$column} = '{$value}'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function eliminar()
    {
        $id = self::$db->escape_string($this->id);
        $query = "DELETE FROM " . static::$tabla . " WHERE id = {$id} LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
        }
        return $resultado;
    }

    public static function consultarSQL($query): array
    {

        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar los resultados
        $array = [];
        while ($row = $resultado->fetch_assoc()) {
            $array[] = static::crearObjecto($row);
        }

        //Liberar la memoria
        $resultado->free();

        return $array;
    }

    protected static function crearObjecto($registro)
    {
        $objeto = new static();
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados en la BD
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
