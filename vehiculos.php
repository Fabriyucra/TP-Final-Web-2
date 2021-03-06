<?php
	session_start();
	include_once dirname(__FILE__) . '/config/DBManager.php';

	if (empty($_SESSION['usuario'])) {
		header("Location: inicio.php");
	}
?>

<!doctype html>
<html lang="es">

<?php require_once('source/link/head.php'); ?>

<body>
	<?php require_once('source/link/ga.php'); ?>
	<?php require_once('source/views/shared/_header.php'); ?>
	<div class="container">
		<!-- Contenido de pagina -->

		<div class="row">
			<div class="col-xs-12">
				<h2 class="text-center">Vehículos</h2>
			</div>
		</div>
        <p>
            <i class="material-icons prefix">print</i>
            <a class="btn-exportar-pdf link" href="source/ABM/vehiculos/PDFDatosVehiculo.php">Exportar listado a PDF</a>
        </p>

		<div class="row">
			<!-- boton nuevo vehiculo -->
			<?php if($_SESSION['id_rol'] == 3  OR $_SESSION['id_rol'] == 4)  { ?> <!-- Botón de agregar Empleado sólo habilitado para rol Supervisor -->
				<div class="col-xs-12">
					<p class="text-center">
						<a href="#modalNuevoVehiculo" id="btn-nuevo-lista" class="w3-button w3-black text-uppercase" data-toggle="modal" data-target="#modalNuevoVehiculo">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
							Agregar nuevo
						</a>
					</p>
				</div>
			<?php } ?>
			<!-- Fin boton nuevo vehiculo -->
			<div class="col-xs-12">
				<!-- Lista Vehiculos -->
				<ul class="list-group" id="lista-vehiculos"></ul>
				<!-- Fin Lista Vehiculos -->
			</div>
		</div>        
	</div>
	<!-- Modal Nuevo Vehiculo -->
	<div class="modal fade" id="modalNuevoVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalNuevoVehiculoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalNuevoVehiculoLabel">Agregar nuevo vehículo</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btn-nuevo-vehiculo" class="w3-button w3-black ">Agregar Nuevo Vehiculo</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Nuevo Vehiculo -->

	<!-- Modal Ver Datos de Vehiculo -->
	<div class="modal fade" id="modalDatosVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalDatosVehiculoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalDatosVehiculoLabel">Datos del vehículo</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Ver Datos de Vehiculo -->

	<!-- Modal Editar Vehiculo -->
	<div class="modal fade" id="modalEditarVehiculo" tabindex="-1" role="dialog" aria-labelledby="modalEditarVehiculoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalEditarVehiculoLabel">Editar ficha del Vehículo</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btn-editar-vehiculo" class="btn btn-primary">Actualizar vehículo</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Editar de Vehiculo -->    
	<!-- Fin Contenido de pagina -->
	<?php
		require_once('source/views/shared/_footer.php');
		require_once('source/link/scripts.php');
	?>
</body>
</html>