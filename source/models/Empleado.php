<?php

namespace source\models\Empleado;

class Empleado {
	public $Id;
	public $nombre;
	public $apellido;
	public $nro_documento;
	public $sexo;
    public $fecha_nacimineto;
    public $fecha_ingreso;
    public $sueldo;
	public $usuario;
	public $password;
    public $rol;
    public $activo;
    public $avatar;

	public function __construct($data = null) {
		if(is_array($data)) {
			$this->id = $data['id'];
			$this->nombre = $data['nombre'];
			$this->apellido = $data['apellido'];
			$this->nro_documento = $data['nro_documento'];
            $this->sexo = $data['sexo'];
            $this->fecha_nacimineto= $data['fecha_nacimiento'];
            $this->fecha_ingreso= $data['fecha_ingreso'];
            $this->sueldo= $data['sueldo'];
            $this->usuario = $data['usuario'];
			$this->password = $data['password'];
            $this->rol = $data['rol'];
            $this->activo= $data['activo'];
            $this->avatar= $data['avatar'];

		}
	}
}