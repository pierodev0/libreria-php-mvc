<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'email', 'password',];
    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$alertas[] = "El correo es obligatorio";
        }
        if (!$this->password) {
            self::$alertas[] = "El password es obligatorio";
        }
        if ($this->password && strlen($this->password) < 6) {
            self::$alertas[] = "El password debe tener al menos 6 caracteres";
        }
        return self::$alertas;
    }


    public function existeUsuario()
    {

        $resultado = self::where('email', $this->email);

        if (!$resultado) {
            self::$alertas[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $autenticado =  password_verify($this->password, $resultado->password);

        if (!$autenticado) {
            self::$alertas[] = "El password es incorrecto";
        }
        return  $autenticado;
    }


    public function autenticar()
    {
        session_start();
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
    }

    public static function attempt($args = []){
        $campos = "";
        foreach($args as $column => $value){
            $campos .= " {$column} = '{$value}' AND";
        }
        $campos = rtrim($campos, " AND");

        $resultado = self::rawSQl("SELECT * FROM users WHERE {$campos} LIMIT 1");
     
    }

    

    

   
}
