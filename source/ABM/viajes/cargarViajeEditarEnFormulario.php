<?php
    session_start();
    require_once("../../../helper/DBManager.php");
    if (empty($_SESSION['usuario'])) header("Location: inicio.php");
    $db = new DBManager();

    $idViaje = $_POST["id"];

    $viaje = $db->ObtenerViajePorId($idViaje);

    $vehiculos = $db->obtenerVehiculos();
    $destinos = $db->obtenerDestinos();
    $clientes = $db->obtenerClientes();
    $choferes = $db->obtenerChoferes();
?>

<form id="formEditarviaje">
    <input type="hidden" name="ID" value="<?php echo $viaje["ID"]; ?>">
    <!--<input type="hidden" name="ACTIVO" value="">-->
    <div class="row">
        <div class="col-xs-12">
            <select name="PATENTE_VEHICULO" class="form-control" required>

                <option value="" disabled selected>Seleccione el Vehículo</option>
                <?php foreach($vehiculos as $vehiculo): ?>
                    <?php if($vehiculo["PATENTE"] == $viaje["PATENTE_VEHICULO"]) { ?>
                        <option value="<?php echo $vehiculo["PATENTE"]; ?>" <?php echo "selected"; ?>>
                            <?php echo $vehiculo["MARCA"]; echo " "; echo $vehiculo["MODELO"];?>
                        </option>
                    <?php } else { ?>
                        <option value="<?php echo $vehiculo["PATENTE"]; ?>">
                            <?php echo $vehiculo["MARCA"]; echo " "; echo $vehiculo["MODELO"];?>
                        </option>
                    <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <select name="ID_EMPLEADO" class="form-control" required>
                <option value="" disabled selected>Seleccione el Chofer</option>
                <?php foreach($choferes as $chofer): ?>
                    <?php if($chofer["ID"] == $viaje["CHOFER_ID"]) {?>
                        <option value="<?php echo $chofer["ID"]; ?>" <?php echo "selected"; ?>>
                            <?php echo $chofer["NOMBRE"]; echo " "; echo $chofer["APELLIDO"];?>
                        </option>
                    <?php } else { ?>
                        <option value="<?php echo $chofer["ID"]; ?>">
                            <?php echo $chofer["NOMBRE"]; echo " "; echo $chofer["APELLIDO"];?>
                        </option>
                    <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>        
    </div>    
    <div class="row">
        <div class="col-xs-12">
            <select name="ID_DESTINO" class="form-control" required>
                <option value="" disabled selected>Seleccione el Destino</option>
                <?php foreach($destinos as $destino): ?>
                    <?php if($destino["ID"] == $viaje["DESTINO_ID"]) {?>
                    <option value="<?php echo $destino["ID"]; ?>" <?php echo "selected"; ?>>
                        <?php echo $destino["DIRECCION"]; echo " "; echo $destino["NUMERO"]; echo ", "; echo $destino["PROVINCIA"]; echo ", "; echo $destino["PAIS"];?>
                    </option>
                <?php } else { ?>
                    <option value="<?php echo $destino["ID"]; ?>">
                        <?php echo $destino["DIRECCION"]; echo " "; echo $destino["NUMERO"]; echo ", "; echo $destino["PROVINCIA"]; echo ", "; echo $destino["PAIS"];?>
                    </option>
                <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <select name="ID_CLIENTE" class="form-control" required>
                <option value="" disabled selected>Seleccione el Cliente</option>
                <?php foreach($clientes as $cliente): ?>
                    <?php if($cliente["ID"] == $viaje["CLIENTE_ID"]) {?>
                        <option value="<?php echo $cliente["ID"]; ?>" <?php echo "selected"; ?>>
                            <?php echo $cliente["RAZON_SOCIAL"];?>
                        </option>
                    <?php } else { ?>                        
                        <option value="<?php echo $cliente["ID"]; ?>">
                            <?php echo $cliente["RAZON_SOCIAL"];?>
                        </option>
                    <?php } ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">Ingrese Fecha Programada</p>
            <input type="date" name="FECHA_PROGRAMADA" value="<?php echo $viaje["FECHA_PROGRAMADA"]; ?>" class="form-control">
        </div>        
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">Ingrese Fecha Inicio</p>
            <input type="date" name="FECHA_INICIO" value="<?php echo $viaje["FECHA_INICIO"]; ?>" class="form-control">
        </div>        
    </div>
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">Ingrese Fecha Fin</p>
            <input type="date" name="FECHA_FIN" value="<?php echo $viaje["FECHA_FIN"]; ?>" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <p>Cantidad De Kilometros</p>
			<label for="CANT_KILOMETROS" class="sr-only">Cantidad de Kilometros</label>
            <input  placeholder="Cantidad de Kilometros" type="text" name="CANT_KILOMETROS" value="<?php echo $viaje["CANT_KILOMETROS"]; ?>" class="form-control">
        </div>

    </div>        
    <!--<div class="row">
        <div class="col-xs-12">
            <a href="#!" id="btn-editar-viaje" class="modal-action btn btn-primary text-uppercase">Actualizar Viaje</a>
        </div>
    </div>-->
</form>