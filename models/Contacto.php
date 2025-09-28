<?php
namespace Model;

class Contacto extends ActiveRecord {
    protected static $tabla = 'contactos';
    protected static $columnasDB = [
        'id','nombre','correo','telefono','empresa','creado_en','actualizado_en'
    ];

    public $id;
    public $nombre;
    public $correo;
    public $telefono;
    public $empresa;
    public $creado_en;
    public $actualizado_en;

    public function __construct($args = []) {
        $this->id             = $args['id'] ?? null;
        $this->nombre         = $args['nombre'] ?? '';
        $this->correo         = $args['correo'] ?? '';
        $this->telefono       = $args['telefono'] ?? '';
        $this->empresa        = $args['empresa'] ?? '';
        $this->creado_en      = $args['creado_en'] ?? date('Y-m-d H:i:s');
        $this->actualizado_en = $args['actualizado_en'] ?? date('Y-m-d H:i:s');
    }

    public function validar() {
        static::$alertas = [];
        if (mb_strlen(trim($this->nombre)) < 2) {
            static::setAlerta('error', 'El nombre es obligatorio (mín. 2 caracteres).');
        }
        if (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            static::setAlerta('error', 'El correo es inválido.');
        }
        return static::$alertas;
    }
}
