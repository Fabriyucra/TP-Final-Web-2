<?php
session_start();
require_once("../../../config/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
$db = new DBManager();

if(empty($_POST["DOMINIO"])) {
    $vehiculos = $db->obtenerVehiculos();
} else {
    $vehiculos = $db->obtenerVehiculosFiltrados($_POST["DOMINIO"]);
}

?>

<?php foreach($vehiculos as $vehiculo): ?>
    
    <?php $avatar = empty($vehiculo["AVATAR"]) ? "default" : $vehiculo["AVATAR"]; ?>

    <li class="list-group-item avatar">
		<div class="media-left">
        	<img src="assets/imagenes/avatares/vehiculos/<?php echo $avatar; ?>.jpg" alt="<?php echo $avatar; ?>" class="img-circle">
		</div>
		<div class="media-body">
			<h4 class="media-heading"><?php echo $vehiculo["DOMINIO"]; ?></h4>
			<p><a class="btn-datos-vehiculo link" data-id="<?php echo $vehiculo["DOMINIO"]; ?>" href="#modalDatosVehiculo" data-toggle="modal" data-target="#modalDatosVehiculo">Ver ficha completa</a></p>
		</div>
        <!-- 
            Los botones de de Editar y Eliminar Vehiculo solo estan disponibles si el usuario
            que esta navegando la aplicación tiene rol de Supervisor 
        -->
        <!-- Eliminar -->
        <?php if($_SESSION['id_rol'] == 4) { ?>
		<div class="media-right">
            <!-- Eliminar -->
            <a href="#!" data-id-eliminar="<?php echo $vehiculo["DOMINIO"]; ?>" class="btn-baja-vehiculo btn btn-primary tooltipped" data-placement="right" title="Eliminar">
                <i class="material-icons">delete</i>
            </a>
            <!-- Editar -->
            <a href="#modalEditarVehiculo" data-id="<?php echo $vehiculo["DOMINIO"]; ?>" class="btn-editar-lista btn btn-primary btn-empleado-editar tooltipped" data-placement="left" title="Editar" data-toggle="modal" data-target="#modalEditarVehiculo">
                <i class="material-icons">playlist_add</i>
            </a>
		</div>
        <?php } ?>
    </li>
<?php endforeach; ?>