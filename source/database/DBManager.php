<?php
//use \PDO;
include_once dirname(dirname(__FILE__)) . '/ConfigGlobal.php';

class DBManager {

	private $configGlobal;
	private $globales;
	private $dbo;

	public function __construct() {

		try {
			$this->configGlobal = new ConfigGlobal();
			$this->globales = $this->configGlobal->ObtenerConfig();

			$this->dbo = new PDO(
				'mysql:host=' . $this->globales["db"]["host"] . ';dbname=' . $this->globales["db"]["nombre"], 
				$this->globales["db"]["usuario"],
				$this->globales["db"]["password"]
			);

			$this->dbo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function validarEmpleadoLogin($usuario, $password) {

		$query = 'select * from empleado where usuario = :usuario and password = :password';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':usuario', $usuario);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerEmpleados() {
		$query =
		' 
			select e.ID, e.NOMBRE, e.APELLIDO, e.DNI, e.SEXO, e.FECHA_NACIMIENTO,
			e.FECHA_INGRESO, e.SUELDO, e.USUARIO, e.AVATAR,
			e.PASSWORD, r.DESCRIPCION ROL
			from empleado e 
			join rol r on e.ID_ROL = r.ID
			where activo = 1
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}	

	public function obtenerEmpleadosFiltrados($datoEmpleado) {
		$query =
		" 
			select e.ID, e.NOMBRE, e.APELLIDO, e.DNI, e.SEXO, e.FECHA_NACIMIENTO,
			e.FECHA_INGRESO, e.SUELDO, e.USUARIO, e.AVATAR,
			e.PASSWORD, r.DESCRIPCION ROL
			from empleado e 
			join rol r on e.ID_ROL = r.ID
			where e.NOMBRE = :datoEmpleado or e.apellido = :datoEmpleado
			and activo = 1
		";
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':datoEmpleado', $datoEmpleado, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function ObtenerEmpleadoPorId($idEmpleado) {
		$query =
		' 
			select e.ID, e.NOMBRE, e.APELLIDO, e.DNI, e.SEXO, e.FECHA_NACIMIENTO,
			e.FECHA_INGRESO, e.SUELDO, e.USUARIO, e.AVATAR,
			e.PASSWORD, r.DESCRIPCION ROL
			from empleado e
			join rol r on e.ID_ROL = r.ID
			where e.ID = :id
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $idEmpleado, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function altaEmpleado($datos) {
		$query = "
			insert into `EMPLEADO`(`NOMBRE`, `APELLIDO`, `DNI`, `SEXO`,
				`FECHA_NACIMIENTO`, `FECHA_INGRESO`, `SUELDO`,
				`USUARIO`, `PASSWORD`, `ID_ROL`, `AVATAR`)
			values(:nombre, :apellido, :dni, :sexo, :fecha_nacimiento,
				:fecha_ingreso, :sueldo, :usuario, :password, :id_rol, :avatar)
		";
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':nombre', $this->configGlobal->normalizarTexto($datos["NOMBRE"]), PDO::PARAM_STR);
			$stmt->bindParam(':apellido', $this->configGlobal->normalizarTexto($datos["APELLIDO"]), PDO::PARAM_STR);
			$stmt->bindParam(':dni', $datos["DNI"], PDO::PARAM_INT);
			$stmt->bindParam(':sexo', $datos["SEXO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_nacimiento', $datos["FECHA_NACIMIENTO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_ingreso', $datos["FECHA_INGRESO"], PDO::PARAM_STR);
			$stmt->bindParam(':sueldo', $datos["SUELDO"], PDO::PARAM_INT);
			$stmt->bindParam(':usuario', $datos["USUARIO"], PDO::PARAM_STR);
			$stmt->bindParam(':password', $datos["PASSWORD"], PDO::PARAM_INT);
			$stmt->bindParam(':id_rol', $datos["ROL"], PDO::PARAM_INT);
			$stmt->bindParam(':avatar', $datos["AVATAR"], PDO::PARAM_STR);
			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function editarEmpleado($datos) {
		$query = "
			update `EMPLEADO`
			set
			`NOMBRE` = :nombre,
			`APELLIDO` = :apellido,
			`DNI` = :dni,
			`SEXO` = :sexo,
			`FECHA_NACIMIENTO` = :fecha_nacimiento,
			`FECHA_INGRESO` = :fecha_ingreso,
			`SUELDO` = :sueldo,
			`USUARIO` = :usuario,
			`PASSWORD` = :password,
			`ID_ROL` = :id_rol,
			`AVATAR` = :avatar
			where `ID` = :id;
		";

		// `ACTIVO` = :activo  <--- agregarlo a la query 
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $datos["ID"], PDO::PARAM_INT);
			$stmt->bindParam(':nombre', $this->configGlobal->normalizarTexto($datos["NOMBRE"]), PDO::PARAM_STR);
			$stmt->bindParam(':apellido', $this->configGlobal->normalizarTexto($datos["APELLIDO"]), PDO::PARAM_STR);
			$stmt->bindParam(':dni', $datos["DNI"], PDO::PARAM_INT);
			$stmt->bindParam(':sexo', $datos["SEXO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_nacimiento', $datos["FECHA_NACIMIENTO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_ingreso', $datos["FECHA_INGRESO"], PDO::PARAM_STR);
			$stmt->bindParam(':sueldo', $datos["SUELDO"], PDO::PARAM_INT);
			$stmt->bindParam(':usuario', $datos["USUARIO"], PDO::PARAM_STR);
			$stmt->bindParam(':password', $datos["PASSWORD"], PDO::PARAM_INT);
			$stmt->bindParam(':id_rol', $datos["ROL"], PDO::PARAM_INT);
			$stmt->bindParam(':avatar', $datos["AVATAR"], PDO::PARAM_STR);
			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function bajaEmpleado($id) {
		try {
			$query = 'UPDATE empleado SET activo = 0 WHERE ID = :id';
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}



	public function obtenerRoles() {
		$query = 'select * from rol';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	/* Viajes */

	public function obtenerViajes() {
		$query =
		' 
			select vi.ID, des.DIRECCION, des.NUMERO, loc.LOCALIDAD, pais.DESCRIPCION PAIS, emp.NOMBRE, emp.APELLIDO, cli.RAZON_SOCIAL CLIENTE
			from viaje vi
			join vehiculo ve on vi.PATENTE_VEHICULO = ve.PATENTE
			join destino des on vi.ID_DESTINO = des.ID
			join localidad loc on des.ID_LOCALIDAD = loc.ID
			join pais on des.ID_PAIS = pais.ID
			join cliente cli on vi.ID_CLIENTE = cli.ID
			join empleado emp on vi.ID_EMPLEADO = emp.ID
			where emp.ID_ROL = 1
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function ObtenerViajePorId($idViaje) {
		$query =
		' 
			select vi.ID, vi.FECHA_PROGRAMADA, vi.FECHA_INICIO, vi.FECHA_FIN,
			vi.CANT_KILOMETROS,des.ID DESTINO_ID ,des.DIRECCION, des.NUMERO, loc.LOCALIDAD,
			pais.DESCRIPCION PAIS, emp.ID CHOFER_ID, emp.NOMBRE CHOFER_NOMBRE, emp.APELLIDO CHOFER_APELLIDO,
			cli.ID CLIENTE_ID, cli.RAZON_SOCIAL CLIENTE,ve.PATENTE PATENTE ,ve.MARCA VEHICULO_MARCA,
			ve.MODELO VEHICULO_MODELO
			from viaje vi
			join vehiculo ve on vi.PATENTE_VEHICULO = ve.PATENTE
			join destino des on vi.ID_DESTINO = des.ID
			join localidad loc on des.ID_LOCALIDAD = loc.ID
			join pais on des.ID_PAIS = pais.ID
			join cliente cli on vi.ID_CLIENTE = cli.ID
			join empleado emp on vi.ID_EMPLEADO = emp.ID
			where vi.ID = :id
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $idViaje, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}	

	public function bajaViaje($id) {
		try {
			$query = 'delete from viaje where ID = :id';
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function editarViaje($datos) {
		$query = "
			update `viaje`
			set
			`PATENTE_VEHICULO` = :patente_vehiculo,
			`ID_DESTINO` = :id_destino,
			`ID_CLIENTE` = :id_cliente,
			`FECHA_PROGRAMADA` = :fecha_programada,
			`FECHA_INICIO` = :fecha_inicio,
			`FECHA_FIN` = :fecha_fin,
			`CANT_KILOMETROS` = :cant_kilometros,
			`ID_TIPO_ACOPLADO` = :id_acoplado,
			`ID_EMPLEADO` = :id_empleado
			where `ID` = :id;
		";

		// `ACTIVO` = :activo  <--- agregarlo a la query 
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $datos["ID"], PDO::PARAM_INT);
			$stmt->bindParam(':dominio_vehiculo', $datos["DOMINIO_VEHICULO"], PDO::PARAM_STR);			
			$stmt->bindParam(':id_destino', $datos["ID_DESTINO"], PDO::PARAM_INT);
			$stmt->bindParam(':id_cliente', $datos["ID_CLIENTE"], PDO::PARAM_INT);
			$stmt->bindParam(':fecha_programada', $datos["FECHA_PROGRAMADA"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_inicio', $datos["FECHA_INICIO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_fin', $datos["FECHA_FIN"], PDO::PARAM_STR);
			$stmt->bindParam(':cant_kilometros', $datos["CANT_KILOMETROS"], PDO::PARAM_INT);
			$stmt->bindParam(':id_acoplado', $datos["ID_ACOPLADO"], PDO::PARAM_INT);				
			$stmt->bindParam(':id_empleado', $datos["ID_EMPLEADO"], PDO::PARAM_INT);
			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}	

	public function obtenerDestinos() {
		$query = '
			select des.ID, des.DIRECCION, des.NUMERO, loc.LOCALIDAD, prov.DESCRIPCION PROVINCIA, pais.DESCRIPCION PAIS
			from destino des
			join localidad loc on des.ID_LOCALIDAD = loc.ID
			join provincia prov on des.ID_PROV = prov.ID
			join pais on des.ID_PAIS = pais.ID
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerClientes() {
		$query = 'select * from cliente';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}	
	}


	public function obtenerChoferes() {
		$query = 'select * from empleado where ID_ROL = 1';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerLocalidades() {
		$query = 'select * from localidad';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerProvincias() {
		$query = 'select * from provincia';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerPaises() {
		$query = 'select * from pais';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function altaViaje($datos) {
		$query = "
			insert into viaje (PATENTE_VEHICULO, ID_EMPLEADO, ID_DESTINO, ID_CLIENTE, FECHA_PROGRAMADA,
				FECHA_INICIO, FECHA_FIN, CANT_KILOMETROS)
			values (:dominio_vehiculo, :id_empleado, :id_destino, :id_cliente, :fecha_programada, :fecha_inicio,
				:fecha_fin, :cant_kilometros, :id_tipo_acoplado)
		";
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':patente_vehiculo', $datos["PATENTE_VEHICULO"], PDO::PARAM_STR);
			$stmt->bindParam(':id_empleado', $datos["ID_EMPLEADO"], PDO::PARAM_INT);
			$stmt->bindParam(':id_destino', $datos["ID_DESTINO"], PDO::PARAM_INT);
			$stmt->bindParam(':id_cliente', $datos["ID_CLIENTE"], PDO::PARAM_INT);
			$stmt->bindParam(':fecha_programada', $datos["FECHA_PROGRAMADA"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_inicio', $datos["FECHA_INICIO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha_fin', $datos["FECHA_FIN"], PDO::PARAM_STR);
			$stmt->bindParam(':cant_kilometros', $datos["CANT_KILOMETROS"], PDO::PARAM_INT);

			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}		


	/* Vehículos */

	public function obtenerVehiculos() {
		$query =
		' 
			select v.PATENTE, v.MARCA, v.MODELO, v.ANO, v.NRO_CHASIS, v.NRO_MOTOR, v.AVATAR
			from vehiculo v
			where v.ACTIVO = 1
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}	


	public function ObtenerVehiculoPorPatente($patenteVehiculo) {
		$query =
		' 
			select v.PATENTE, v.MARCA, v.MODELO, v.ANO, v.NRO_CHASIS, v.NRO_MOTOR, v.AVATAR
			from vehiculo v 
			where v.PATENTE = :patente
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':patente', $patenteVehiculo, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function bajaVehiculo($patente) {
		try {
			$query = 'UPDATE vehiculo SET activo = 0 WHERE patente = :patente';
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':patente', $patente);
			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function altaVehiculo($datos) {
		$query = "
			insert into `VEHICULO`(`PATENTE`, `MODELO`, `MARCA`, `ANO`,
				`NRO_CHASIS`, `NRO_MOTOR`, `AVATAR`)
			values(:patente, :modelo, :marca, :ano, :nro_chasis,
				:nro_motor, :avatar)
		";
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':patente', $datos["PATENTE"], PDO::PARAM_STR);
			$stmt->bindParam(':modelo', $datos["MODELO"], PDO::PARAM_STR);
			$stmt->bindParam(':marca', $datos["MARCA"], PDO::PARAM_STR);
			$stmt->bindParam(':ano', $datos["ANO"], PDO::PARAM_INT);
			$stmt->bindParam(':nro_chasis', $datos["NRO_CHASIS"], PDO::PARAM_INT);
			$stmt->bindParam(':nro_motor', $datos["NRO_MOTOR"], PDO::PARAM_INT);
			$stmt->bindParam(':avatar', $datos["AVATAR"], PDO::PARAM_STR);
			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function editarVehiculo($datos) {
		$query = "
			update `VEHICULO`
			set
			`MODELO` = :modelo,
			`MARCA` = :marca,
			`ANO` = :ano,
			`NRO_CHASIS` = :nro_chasis,
			`NRO_MOTOR` = :nro_motor
			 where `PATENTE` = :patente;
		";

		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':patente', $datos["PATENTE"], PDO::PARAM_STR);
			$stmt->bindParam(':modelo', $datos["MODELO"], PDO::PARAM_STR);
			$stmt->bindParam(':marca', $datos["MARCA"], PDO::PARAM_STR);
			$stmt->bindParam(':ano', $datos["ANO"], PDO::PARAM_INT);
			$stmt->bindParam(':nro_chasis', $datos["NRO_CHASIS"], PDO::PARAM_INT);
			$stmt->bindParam(':nro_motor', $datos["NRO_MOTOR"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}
	/*FIN VEHICULOS*/

	/* Seguimientos */

	public function obtenerParadas($idViaje) {
		$query = '
			select parada.LATITUD LATITUD, parada.LONGITUD LONGITUD
			from viaje
			join destino on viaje.ID_DESTINO = destino.ID
			join parada on parada.ID_DESTINO = destino.ID
			where viaje.ID = :idViaje
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':idViaje', $idViaje, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}
	/* Reportes */
	public function obtenerUsosdeCamionesEnAcualAnio() {
		$anioActual = date("Y");
		$query =
		' 
			select vehiculo.MODELO, vehiculo.MARCA, count(*) CANT_VEHICULO_VIAJES
			from viaje
			join vehiculo on vehiculo.DOMINIO = viaje.DOMINIO_VEHICULO
			where YEAR(viaje.FECHA_INICIO) = :anioActual
			group by DOMINIO_VEHICULO
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':anioActual', $anioActual, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerClientesEnAcualAnio() {
		$anioActual = date("Y");
		$query =
		' 
			select cliente.RAZON_SOCIAL NOMBRE, count(*) CLIENTE_VECES
			from viaje
			join cliente on viaje.ID_CLIENTE = cliente.ID
			where YEAR(viaje.FECHA_INICIO) = :anioActual
			group by viaje.ID_CLIENTE
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':anioActual', $anioActual, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerViajesChoferesEnAcualAnio() {
		$anioActual = date("Y");
		$query =
		' 
			select empleado.NOMBRE, empleado.APELLIDO, count(*) CHOFER_VECES
			from viaje
			join empleado on viaje.ID_EMPLEADO = empleado.ID
			where YEAR(viaje.FECHA_INICIO) = :anioActual
			group by viaje.ID_EMPLEADO
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':anioActual', $anioActual, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}



    /* Servicio */
    public function obtenerAlarmasMantenimientos() {
    	$hoy = date('Y-m-d');

		$query =
		' 
			select *
			from service 
			where service.activo = 1 and :hoy >= service.fecha and service.realizado = 0
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':hoy', $hoy, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
    }
	public function obtenerMantenimientos() {
		$query =
		' 
			select *
			from service 
			where activo = 1
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function obtenerMantenimientoPorID($idMantenimiento) {
		$query =
		' 
			select s.*, e.NOMBRE, e.APELLIDO
			from service s
			inner join empleado e
			on s.empleado_encargado	= e.ID
			where s.id = :id
		';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $idMantenimiento, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetch();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function altaMantenimiento($datos) {
		$query = "
			insert into `SERVICE`(`DOMINIO_VEHICULO`, `FECHA`, `KM_VEHICULO`, `COSTO`,
				`EMPLEADO_ENCARGADO`, `COMENTARIO`)
			values(:dominio_vehiculo, :fecha, :km_vehiculo, :costo,
				:empleado_encargado, :comentario)
		";
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':dominio_vehiculo', $datos["DOMINIO_VEHICULO"], PDO::PARAM_STR);
			$stmt->bindParam(':fecha', $datos["FECHA"], PDO::PARAM_STR);
			$stmt->bindParam(':km_vehiculo', $datos["KM_VEHICULO"], PDO::PARAM_INT);
			$stmt->bindParam(':costo', $datos["COSTO"], PDO::PARAM_INT);
			$stmt->bindParam(':empleado_encargado', $datos["EMPLEADO_ENCARGADO"], PDO::PARAM_INT);
			$stmt->bindParam(':comentario', $datos["COMENTARIO"], PDO::PARAM_STR);
			//$stmt->bindParam(':activo', $datos["ACTIVO"], PDO::PARAM_INT);

			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function bajaMantenimiento($id) {
		try {
			$query = 'UPDATE service SET activo = 0 WHERE id = :id';
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function marcarMantenimientoRealizado($id) {
		try {
			$query = 'UPDATE service SET realizado = 1 WHERE id = :id';
			$stmt = $this->dbo->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}
	}

	public function obtenerDominios() {
		$query = 'select PATENTE from vehiculo where activo=1';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}

	public function obtenerMecanicos() {
		$query = 
		//Traigo solo MECANICOS
		'
		 select e.ID, e.NOMBRE, e.APELLIDO
		 from empleado e
		 where e.ACTIVO = 1
		 and e.ID_ROL = 2 
		 ';
		try {
			$stmt = $this->dbo->prepare($query);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt->fetchAll();
		}
		catch(PDOException $ex) {
			print "Chan: " . $ex->getMessage();
			die();
		}		
	}
}