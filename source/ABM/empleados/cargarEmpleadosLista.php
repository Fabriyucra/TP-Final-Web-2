<?php
session_start();
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
require_once("../../../config/DBManager.php");
$db = new DBManager();

$empleados = $db->obtenerEmpleados();

?>

<?php foreach($empleados as $empleado): ?>

    <?php $avatar = empty($empleado["AVATAR"]) ? "default" : $empleado["AVATAR"]; ?>

    <li class="list-group-item avatar">
		<div class="media">
			<div class="media-left">
        		<img src="assets/imagenes/avatares/empleados/<?php echo $avatar; ?>.jpg" alt="<?php echo $avatar; ?>" class="img-circle">
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php echo $empleado["NOMBRE"]; ?>&nbsp;<?php echo $empleado["APELLIDO"]; ?></h4>
				<p class="w3-khaki"><?php echo $empleado["ROL"]; ?>
				</p>
				<p><a class="btn-datos-empleado link" data-id="<?php echo $empleado["ID"]; ?>" href="#modalDatosEmpleado" data-toggle="modal" data-target="#modalDatosEmpleado">Ver perfil completo</a></p>
				<!-- 
					Los botones de de Editar y Eliminar Empleado solo estan disponibles si el usuario
					que esta navegando la aplicación tiene rol de Supervisor 
				-->
			</div>
			<?php if($_SESSION['id_rol'] == 3) { ?>
			<div class="media-right">
				<!-- Eliminar -->
				<a href="#!" data-id-eliminar="<?php echo $empleado["ID"]; ?>" class="btn-baja-empleado w3-button w3-black tooltipped" data-placement="right" title="Eliminar">
                    <i class="fa fa-trash" aria-hidden="true"></i>
				</a>
				<!-- Editar -->
				<a href="#modalEditarEmpleado" data-id="<?php echo $empleado["ID"]; ?>" class="btn-editar-lista w3-margin-top w3-button btn-empleado-editar tooltipped" data-placement="left" title="Editar" data-toggle="modal" data-target="#modalEditarEmpleado">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
			</div>
			<?php } ?>
		</div>
    </li>
<?php endforeach; ?>