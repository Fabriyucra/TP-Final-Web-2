<?php

namespace source\models\Vehiculo;

class Vehiculo {
	public $patente;
    public $modelo;
	public $ano;
    public $marca;
	public $nro_chasis;
	public $nro_motor;
	public $activo;
	public $avatar;

	public function __construct($data = null) {
		if(is_array($data)) {
			$this->patente = $data['patente'];
            $this->modelo = $data['modelo'];
			$this->ano = $data['ano'];
			$this->marca = $data['marca'];
			$this->nro_chasis = $data['nro_chasis'];
			$this->nro_motor = $data['nro_motor'];
			$this->activo = $data['activo'];
            $this->avatar = $data['avatar'];
		}
	}
}