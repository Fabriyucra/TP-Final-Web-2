<?php
	session_start();
    require_once("../../../config/DBManager.php");
	if (empty($_SESSION['usuario'])) header("Location: inicio.php");
    $db = new DBManager();

    $idUsuario = $_POST["id"];

    $mantenimiento = $db->obtenerMantenimientoPorID($idUsuario); 
?>

<div class="row">

	<div class="col-xs-12 col-sm-6">
		<ul class="list-group">
			<li class="list-group-item">ID: <?php echo $mantenimiento["ID"]; ?></li>
			<li class="list-group-item">Patente: <?php echo $mantenimiento["PATENTE_VEHICULO"]; ?></li>
			<li class="list-group-item">Fecha: <?php echo $mantenimiento["FECHA"]; ?></li>
		</ul>		
	</div>
	<div class="col-xs-12 col-sm-6">
		<ul class="list-group">
			<li class="list-group-item">Costo: $<?php echo $mantenimiento["COSTO"]; ?>.-</li>
			<li class="list-group-item">Kilometros: <?php echo $mantenimiento["KM_VEHICULO"]; ?></li>
		    <li class="list-group-item">Mecanico encargado: <?php echo $mantenimiento["NOMBRE"]; ?>&nbsp;<?php echo $mantenimiento["APELLIDO"]; ?></li>	
		</ul>		
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<ul class="list-group">
	   		<li class="list-group-item">Trabajo realizado: <?php echo $mantenimiento["COMENTARIO"]; ?></li>
		</ul>
	</div>
</div>