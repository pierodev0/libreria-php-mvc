<?php

namespace Model;

class User extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'email', 'password',];
    public $id;
    public $email;
    public $password;
    public $password_confirmation;
    public $token;
    public $confirmed;
    public $admin;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password_confirmation = $args['password_confirmation'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->admin = $args['admin'] ?? 0;
    }

    public function validarRegistro()
    {
        if (!$this->email) {
            self::setAlerta('error', 'El correo es obligatorio');
        }
        if($this->email &&!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error', 'El email es invalido');
        }

        if (!$this->password) {
            self::setAlerta('error', 'El password es obligatorio');
        }
        if ($this->password && $this->password_confirmation && strlen($this->password) < 6 && strlen($this->password_confirmation) < 6) {
            self::setAlerta('error', 'El password debe tener al menos 6 caracteres');
        }
        if ($this->password !== $this->password_confirmation) {
            self::setAlerta('error', 'Los password no son iguales');
        }
        return self::$alertas;
    }

    function validarLogin(){
        if (!$this->email) {
            self::setAlerta('error', 'El correo es obligatorio');
        }
        if($this->email &&!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error', 'El email es invalido');
        }

        if (!$this->password) {
            self::setAlerta('error', 'El password es obligatorio');
        }
        return self::$alertas;
    }

    public function existeEmail()
    {

        $resultado = self::where('email', $this->email);

        if ($resultado) {
            self::setAlerta('error', "El email ya esta registrado");
            return true;
        }
        
        return false ;
    }

    public function existeUsuario()
    {

        $resultado = self::where('email', $this->email);

        if (!$resultado) {
            self::setAlerta('error', "El usuario no existe");
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $autenticado =  password_verify($this->password, $resultado->password);

        if (!$autenticado) {
            self::setAlerta('error', "El password es incorrecto");
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
