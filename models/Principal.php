<?php

namespace Model;

class Principal
{
    // Base de datos
    protected static $bd;
    protected static $tabla = '';
    protected static $columnasDB = [];


    // Definir la conexion a la bd
    public static function setDB($database)
    {
        self::$bd = $database;
    }

    // Errores
    protected static $errores = [];


    public function guardar()
    {
        $resultado = false;
        if (!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // crear
            $resultado = $this->crear();
        }
        return $resultado;
    }

    public function crear()
    {
        // Sanitizar los datos
        $attr = $this->sanitizarAtributos();
        
        if(static::$tabla === 'propiedades'){
            $attr['slug'] = slugify($this->titulo);
        }

        // Insertar en la base de datos    
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($attr));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attr));
        $query .= "')";

        $resultado = self::$bd->query($query);

        if($resultado){
            return true;
        }else{
            return false;
        }

        
    }

    public function actualizar()
    {
        // Sanitizar los datos
        $attr = $this->sanitizarAtributos();
        if(static::$tabla === 'propiedades'){
            $attr['slug'] = slugify($this->titulo);
        }

        $valores = [];

        foreach ($attr as $k => $v) {
            $valores[] = "{$k}='${v}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$bd->escape_string($this->id) . "'";
        $query .= " LIMIT 1 ";

        $resultado = self::$bd->query($query);

        if($resultado){
            return true;
        }else{
            return false;
        }
    }

    public function eliminar()
    {

        $query = "DELETE FROM " . static::$tabla . " WHERE id = '" . self::$bd->escape_string($this->id) . "' LIMIT 1";

        $resultado = self::$bd->query($query);

        if($resultado){
            $this->deleteImagen();
            return true;
        }else{
            return false;
        }
    }
    // Identificar y unir los atributos de la DB
    public function atributos(): array
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            if(static::$tabla === 'propiedades'){
                if ($columna === 'slug') continue;
            }
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Sanitizar datos
    public function sanitizarAtributos(): array
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $k => $v) {
            $sanitizado[$k] = self::$bd->escape_string($v);
        }

        return $sanitizado;
    }

    public function setImagen($imagen)
    {
        // Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->deleteImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    public function deleteImagen()
    {
        // Verificar so exoste eñ archivo
        $existeArchivo = file_exists(CARPETA_IMG . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMG . $this->imagen);
        }
    }
    // Validación
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";

        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Obtiene determinado número de registros.
    public static function get($limite){
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC LIMIT " . $limite . " ";

        $resultado = self::consultarSQL($query);
        
        return $resultado;
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id} ORDER BY id DESC";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function getBySlug($slug){
        $query = "SELECT * FROM " . static::$tabla . " WHERE slug = '${slug}' ORDER BY id DESC";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$bd->query($query);


        // Iterar los resultados
        $array = [];
        while ($registro  = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function  crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $k => $v) {
            if (property_exists($this, $k) && !is_null($v)) {
                $this->$k = $v;
            }
        }
    }
}
