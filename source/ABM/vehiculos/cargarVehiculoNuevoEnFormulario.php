<?php
    session_start();
    require_once("../../../helper/DBManager.php");
    if (empty($_SESSION['usuario'])) header("Location: inicio.php");
    $db = new DBManager();

?>

<form id="formNuevoVehiculo">
    <!--<input type="hidden" name="ACTIVO" value="">-->
    <div class="row">
        <div class="col-xs-12 col-xs-6">
		<label for="dominio">Patente</label>
            <input id="dominio" name="DOMINIO" type="text" class="form-control" required>
        </div>
        <div class="col-xs-12 col-xs-6">
		<label for="marca">Marca</label>
            <input id="marca" name="MARCA" type="text" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-6">
		<label for="dominio">Modelo</label>
            <input id="dominio" name="MODELO" type="text" class="form-control">
        </div>
        <div class="col-xs-12 col-xs-6">
		<label for="anio">Año</label>
            <input id="anio" name="ANO" type="text" class="form-control">
        </div>                                                
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-6">
		<label for="chasis">Nro.Chasis</label>
            <input id="chasis" name="NRO_CHASIS" type="text" class="form-control">
        </div>
        <div class="col-xs-12 col-xs-6">
		<label for="motor">Nro.Motor</label>
            <input id="motor" name="NRO_MOTOR" type="text" class="form-control">
        </div>                                                
    </div>     
    <div class="row">
        <div class="col-xs-12">
		<label for="avatar">AVATAR</label>
            <input id="avatar" name="AVATAR" type="text" class="form-control">
        </div>                                                
    </div>
    <!--<div class="row">
        <div class="col-xs-12">
            <a href="#!" id="btn-nuevo-vehiculo" class="modal-action modal-close btn btn-primary text-uppercase">Agregar Nuevo Vehiculo</a>
        </div>
    </div>-->
</form>
