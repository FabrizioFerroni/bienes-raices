<?php

namespace Model;

class Propiedad extends Principal
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = [
        'id',
        'slug',
        'titulo',
        'precio',
        'imagen',
        'descripcion',
        'habitaciones',
        'wc',
        'estacionamiento',
        'creado',
        'vendedores_id',
    ];

    public $id;
    public $slug;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->slug = $args['slug'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }


    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        }

        if (!$this->precio) {
            self::$errores[] = 'Debes añadir un precio';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }
        
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Debes añadir la cantidad de habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = 'Debes añadir la cantidad de baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Debes añadir la cantidad de estacionamientos';
        }
        if (!$this->vendedores_id) {
            self::$errores[] = 'Debes añadir un vendedor';
        }

        

        return self::$errores;
    }
  
}
