<?php
    session_start();

    require_once("../../../config/DBManager.php");
    if (empty($_SESSION['usuario'])) header("Location: inicio.php");
    $db = new DBManager();

    $dominioVehiculo = $_POST["dominio"];

    $vehiculo = $db->ObtenerVehiculoPorPatente($dominioVehiculo);
?>

<form id="formEditarVehiculo">
    <h4><?php echo $vehiculo["PATENTE"];?></h4>

    <input type="hidden" name="PATENTE" value="<?php echo $vehiculo["PATENTE"]; ?>"> <br>
    <!--<input type="hidden" name="ACTIVO" value="">-->
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="">Patente</label>
            <input id="patente" placeholder="Ingrese patente" name="PATENTE" type="text" class="form-control" value="<?php echo $vehiculo["PATENTE"];?>" required disabled>
        </div>
        <br>

        <div class="col-xs-12 col-sm-6">
            <label for="">Año de fabricacion</label>
            <input id="ano" placeholder="Ingrese año" name="ANO" type="number" class="form-control" value="<?php echo $vehiculo["ANO"];?>" required>
        </div>
        <br>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="">Marca de vehiculo</label>
            <input id="marca" placeholder="Ingrese marca" name="MARCA" type="text" class="form-control" value="<?php echo $vehiculo["MARCA"];?>">
        </div>
        <br>
        <div class="col-xs-12 col-sm-6">
            <label for="">Modelo de vehiculo</label>
            <input id="modelo" placeholder="Ingrese modelo" name="MODELO" type="text" class="form-control" value="<?php echo $vehiculo["MODELO"];?>">
        </div>
        <br>
    </div>                                        
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="">NRO* de Chasis</label>
            <input id="nro_chasis" placeholder="Ingrese nro.chasis" name="NRO_CHASIS" type="number" class="form-control" value="<?php echo $vehiculo["NRO_CHASIS"];?>">
        </div>
        <br>
        <div class="col-xs-12 col-sm-6">
            <label for="">NRO* de Motor</label>
            <input id="nro_motor" placeholder="Ingrese nro.motor" name="NRO_MOTOR" type="number" class="form-control" value="<?php echo $vehiculo["NRO_MOTOR"];?>">
        </div>


    </div>                                        
    <!--<div class="row">
        <div class="col-xs-12">
            <a href="#!" id="btn-editar-vehiculo" class="modal-action btn btn-primary text-uppercase">Actualizar vehículo</a>
        </div>
    </div>-->
</form>