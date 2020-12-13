<?php
	session_start();
	include_once dirname(__FILE__) . '/helper/DBManager.php';

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
		<div class="row">
			<div class="col-xs-12">
				<h2 class="text-center">Empleados</h2>
            </div>
        </div>

		<!-- Contenido de pagina -->
		<div class="row">
			<!-- boton nuevo empleado -->
			<?php if($_SESSION['id_rol'] == 4) { ?> <!-- Botón de agregar Empleado sólo habilitado para rol Administrador -->
				<div class="col-xs-12">
					<p class="text-center">
						<a href="#modalNuevoEmpleado" id="btn-nuevo-lista" class="w3-button w3-black text-uppercase" data-toggle="modal" data-target="#modalNuevoEmpleado">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
							Agregar nuevo empleado
						</a>
					</p>
				</div>
			<?php } ?>
			<!-- Fin boton nuevo empleado -->
			<div class="col-xs-12">
				<!-- Lista Empleados PDF-->
                <p>
                    <i class="material-icons prefix">print</i>
                    <a class="btn-exportar-pdf link" href="#">Exportar listado a PDF</a>
                </p>

				<ul class="list-group" id="lista-empleados"></ul>
				<!-- Fin Lista Empleados -->
			</div>
		</div>
	</div>
	<!-- Modal Nuevo Empleado -->
	<div class="modal fade" id="modalNuevoEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalNuevoEmpleadoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalNuevoEmpleadoLabel">Nuevo empleado</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id="btn-nuevo-empleado" class="btn w3-black ">Agregar Nuevo Empleado</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Nuevo Empleado -->

	<!-- Modal Ver Datos de Empleado -->
	<div class="modal fade" id="modalDatosEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalDatosEmpleadoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalDatosEmpleadoLabel">Datos del empleado</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div> 
	<!-- Fin Modal Ver Datos de Empleado -->

	<!-- Modal Editar Empleado -->
	<div class="modal fade" id="modalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="modalEditarEmpleadoLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalEditarEmpleadoLabel">Editar empleado</h4>
				</div>
				<div class="modal-body"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button"id="btn-editar-empleado" class="btn w3-black">Actualizar Empleado</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal Editar de Empleado -->

	<!-- Modal Cargando -->
	<div class="modal fade" id="modalCargando" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<h5>Procesando datos...</h5>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
	<!-- Fin Modal Cargando -->

	<!-- Fin Contenido de pagina -->
	 <?php
		require_once('source/views/shared/_footer.php');
		require_once('source/link/scripts.php');
	?>
            <script type="text/javascript">
                var empleados = new Empleados();
                empleados.cargarLista();
                empleados.cargarEventoBtnFiltroEmpleado();
            </script>


