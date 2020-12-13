<?php
session_start();
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
$db = new DBManager();

$vehiculos = $db->obtenerVehiculos();
?>

<?php foreach($vehiculos as $vehiculo):?>

    <?php $avatar = empty($vehiculo["AVATAR"]) ? "default" : $vehiculo["AVATAR"]; ?>

    <li class="list-group-item">
		<div class="media">
			<div class="media-left">
				<img src="assets/imagenes/avatares/vehiculos/<?php echo $avatar; ?>.jpg" alt="<?php echo $avatar; ?>" class="img-circle">
			</div>
			<div class="media-body">
				<h4 class="media-heading"><?php echo $vehiculo["PATENTE"]; ?></h4>
				<p><a class="btn-datos-vehiculo link" data-id="<?php echo $vehiculo["PATENTE"]; ?>" href="#modalDatosVehiculo" data-toggle="modal" data-target="#modalDatosVehiculo">Ver ficha completa</a></p>
				<!-- 
					Los botones de de Editar y Eliminar Empleado solo estan disponibles si el usuario
					que esta navegando la aplicación tiene rol de Supervisor 
				-->
				<!-- Eliminar -->
			</div>
			<?php if($_SESSION['id_rol'] == 4) { ?>
			<div class="media-right">
				<a href="#!" data-id-eliminar="<?php echo $vehiculo["PATENTE"]; ?>" class=" btn-baja-vehiculo w3-button w3-black  tooltipped" data-placement="right" title="Eliminar">
                    <i class="fa fa-trash" aria-hidden="true"></i>
				</a>
				<!-- Editar -->
				<a href="#modalEditarVehiculo" data-id="<?php echo $vehiculo["PATENTE"]; ?>" class="btn-editar-lista w3-margin-top w3-button w3-black  btn-empleado-editar tooltipped" data-placement="left" title="Editar" data-toggle="modal" data-target="#modalEditarVehiculo">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				</a>
			</div>
			<?php } ?>
		</div>
    </li>
<?php endforeach; ?>