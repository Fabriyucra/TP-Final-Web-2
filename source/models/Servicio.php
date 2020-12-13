<?php

namespace source\models\Mantenimiento;

class Servicio {
	public $id;
	public $patente_vehiculo;
	public $fecha;
	public $km_vehiculo;
	public $costo;
	public $comentario;
    public $activo;
    public $empleado_encargado;
    public $realizado;



	public function __construct($data = null) {
		if(is_array($data)) {
			$this->id = $data['id'];
			$this->patente_vehiculo = $data['dominio_vehiculo'];
			$this->fecha = $data['fecha'];
			$this->km_vehiculo = $data['km_vehiculo'];
			$this->costo = $data['costo'];
			$this->comentario = $data['comentario'];
            $this->activo = $data['activo'];
            $this->empleado_encargado = $data['empleado_encargado'];
            $this->realizado= $data['realizado'];
		}
	}
}