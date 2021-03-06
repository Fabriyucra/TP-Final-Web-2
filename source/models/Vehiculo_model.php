<?php

require_once 'ModelInterface.php';
require_once ("config/DataBase.php");

class Vehiculo_model implements ModelInterface
{
	private $_db;
	private $_ID = null;
	private $_PATENTE;
	private $_ACTIVO;
	private $_MARCA;
	private $_NRO_CHASIS;
	private $_NRO_MOTOR;
	private $_ANO;


	public function __construct()
	{
		$this->_db = DataBase::getInstance();
	}

	public function setId($ID)
	{
		$this->_ID = $ID;
	}

	public function getId()
	{
		return $this->_ID;
	}

	public function setPatente($DOMINIO)
	{
		$this->_PATENTE = $DOMINIO;
	}

	public function getPatente()
	{
		return $this->_PATENTE;
	}

	public function setEstado($ACTIVO)
	{
		$this->_ACTIVO = $ACTIVO;
	}

	public function getEstado()
	{
		return $this->_ACTIVO;
	}

	public function setMarca($_MARCA)
	{
		$this->_MARCA = $_MARCA;
	}

	public function getMarca()
	{
		return $this->_MARCA;
	}

	public function setNroChasis($_NRO_CHASIS)
	{
		$this->_NRO_CHASIS = $_NRO_CHASIS;
	}

	public function getNroChasis()
	{
		return $this->_NRO_CHASIS;
	}

	public function setNroMotor($_NRO_MOTOR)
	{
		$this->_NRO_MOTOR = $_NRO_MOTOR;
	}

	public function getNroMotor()
	{
		return $this->_NRO_MOTOR;
	}

	public function setFechaFabricacion($_ANO)
	{
		$this->_ANO = $_ANO;
	}

	public function getFechaFabricacion()
	{
		return $this->_ANO;
	}

	private function verifyPatente()
	{
		$query = sprintf("SELECT ID FROM vehiculo WHERE PATENTE = '%s'", $this->_PATENTE);
		$rs = $this->_db->query($query);
		return $rs;
	}

	public function save()
	{
		$existPatente = $this->verifyPatente();

		if( is_null($this->_ID) )
		{
			//Insert
			if(isset($existPatente[0]->ID) && $existPatente[0]->ID != '')
				return false;
			else
				$query = sprintf("INSERT INTO vehiculo(ID, PATENTE, MODELO, ANO, MARCA, NRO_CHASIS, NRO_MOTOR, ACTIVO, avatar, ID_ACOPLADO) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $this->ID,$this->DOMINIO, $this->modelo, $this->ANO, $this->MARCA, $this->NRO_CHASIS,$this->NRO_MOTOR, $this->ACTIVO, $this->avatar, $this->ID_ACOPLADO);
		}
		else
		{
			//Update
			$query = sprintf("UPDATE vehiculo SET ID = '%s', PATENTE = '%s', MODELO = '%s', ANO = '%s', NRO_CHASIS = '%s', NRO_MOTOR = '%s', ACTIVO = '%s', avatar = '%s', ID_ACOPLADO = '%s' WHERE ID = %s", $this->ID, $this->DOMINIO, $this->modelo, $this->ANO, $this->MARCA, $this->NRO_CHASIS,$this->NRO_MOTOR,$this->ACTIVO, $this->avatar, $this->ID_ACOPLADO);
		}

		$rs = $this->_db->query($query);
		return $rs;
	}




	public function delete()
	{
		$query = sprintf("DELETE FROM vehiculo WHERE ID = %s", $this->ID);
		$rs =  $this->_db->query($query);
		return $rs;
	}



	public function getEstadoVehiculo()
	{
		$query = "SELECT ID, ACTIVO FROM vehiculo";
		$rows =  $this->_db->query($query);
		return $rows;
	}

		static	public function getReporteDiasFueraDeServicio()
	{
		 $_db = DataBase::getInstance();
		 $query = "SELECT v.ID, v.MARCA, v.PATENTE, v.ANO, sum(DATEDIFF(m.fecha,m.fecha)) AS 'DiasInactivo'
				 FROM vehiculo v JOIN service m
				 ON v.ID=m.PATENTE_vehiculo
				 Group BY v.ID , v.MARCA, v.DOMINIO";
		 return $_db->query($query);
	}

		static	public function getReporteCostoMantenimiento()
	{
		 $_db = DataBase::getInstance();
		 $query = "SELECT v.ID, v.MARCA, v.PATENTE, v.ANO,sum(m.costo) AS 'CostoMantenimiento'
				FROM vehiculo v JOIN service m
				ON v.ID=m.PATENTE_vehiculo
				Group BY v.ID , v.MARCA, v.PATENTE";
	   return $_db->query($query);
	}

		static public function getReporteKilometrosRecorridos()
	{
		   $_db = DataBase::getInstance();
			 $query = "SELECT v.ID, v.MARCA, v.PATENTE,v.ANO,MAX(m.km_vehiculo) AS 'KilometrosRecorridos'
									FROM vehiculo v JOIN service m ON v.ID=m.PATENTE_vehiculo
									Group BY v.ID , v.MARCA, v.PATENTE";
	     return $_db->query($query);
	}

	static public function getAllStatic()
	{
		  $_db = DataBase::getInstance();
			$query = "SELECT *
					FROM vehiculo ";
  		return $_db->query($query);
	}

static public function getConsumo()
{$_db= DataBase::getInstance();
$query ="SELECT t.DESCRIPCION as'vehiculo',  sum(v.KILOMETROS_REAL)/ sum(v.CONSUMO_REAL) as 'consumo'
FROM viaje v join  vehiculo ve on ve.id=v.PATENTE_VEHICULO JOIN acoplado t on t.ID=ve.ID_ACOPLADO
WHERE t.ID <>4
GROUP by t.ID , t.DESCRIPCION";
return $_db->query($query);

}
static public function getCantidadViajes(){

	$_db= DataBase::getInstance();
	$query =	"SELECT tp.DESCRIPCION as 'vehiculo' , COUNT(vi.ID) as 'viajes'
FROM vehiculo ve JOIN acoplado tp on ve.ID_ACOPLADO=tp.ID  JOIN viaje vi ON vi.PATENTE_vehiculo=ve.ID
where tp.ID <>4
GROUP by tp.ID";
return $_db->query($query);
}





}
