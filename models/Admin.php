<?php

namespace Model;

class Admin extends Principal
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'email',
        'password'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'Debes ingresar un email';
        }

        if (!$this->password) {
            self::$errores[] = 'Debes ingresar una contraseña';
        }


        return self::$errores;
    }

    public function existeUsuario()
    {
        // Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$bd->query($query);
        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario y/o contraseña son incorrectos";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = "No te has podido autenticar, prueba mas tarde";
        }

        return $autenticado;
    }


    public function autenticar()
    {
        $email = '';
        session_start();

        // Llenar el arreglo de sesion
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['apellido'] = $usuario['apellido'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['login'] = true;
        $_SESSION['resultado'] = "ok";
        $_SESSION['mensaje'] = "Te has logueado con éxito";

        header("Location:/admin");
    }
}
