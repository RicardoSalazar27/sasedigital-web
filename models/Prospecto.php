<?php
namespace Model;

class Prospecto extends ActiveRecord {
    protected static $tabla = 'prospectos';
    protected static $columnasDB = [
        'id','contacto_id','servicio_id','servicio_texto','mensaje','referencia',
        'consentimiento','ip','agente_usuario','estado','fuente',
        'hash_deduplicacion','creado_en'
    ];

    public $id;
    public $contacto_id;
    public $servicio_id;
    public $servicio_texto;
    public $mensaje;
    public $referencia;
    public $consentimiento;
    public $ip;
    public $agente_usuario;
    public $estado;
    public $fuente;
    public $hash_deduplicacion;
    public $creado_en;

    public function __construct($args = []) {
        $this->id                 = $args['id'] ?? null;
        $this->contacto_id        = $args['contacto_id'] ?? null;
        $this->servicio_id        = (int)($args['servicio_id'] ?? 0);
        $this->servicio_texto     = $args['servicio_texto'] ?? '';
        $this->mensaje            = $args['mensaje'] ?? '';
        $this->referencia         = $args['referencia'] ?? '';
        $this->consentimiento     = (int)($args['consentimiento'] ?? 0);
        $this->ip                 = $args['ip'] ?? '';
        $this->agente_usuario     = $args['agente_usuario'] ?? '';
        $this->estado             = $args['estado'] ?? 'nuevo';
        $this->fuente             = $args['fuente'] ?? 'web';
        $this->hash_deduplicacion = $args['hash_deduplicacion'] ?? null;
        $this->creado_en          = $args['creado_en'] ?? date('Y-m-d H:i:s');
    }

    public function validar() {
        static::$alertas = [];
        if (empty($this->contacto_id)) {
            static::setAlerta('error', 'Falta el contacto.');
        }
        if ($this->servicio_id === 0) {
            static::setAlerta('error', 'Selecciona un interés.');
        }
        if (mb_strlen(trim($this->mensaje)) < 10) {
            static::setAlerta('error', 'El mensaje es demasiado corto.');
        }
        return static::$alertas;
    }
}
