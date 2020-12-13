<?php
session_start();
require_once("../../../helper/DBManager.php");
$db = new DBManager();

$roles = $db->obtenerRoles();
?>

<form id="formRegistrarEmpleado">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="nombre">Nombre</label>
            <input id="nombre" name="NOMBRE" type="text" class="form-control" required>
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="apellido">Apellido</label>
            <input id="apellido" name="APELLIDO" type="text" class="form-control" required>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="DNI">Número de documento</label>
            <input name="DNI" type="number" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <input id="radioMasculino" name="SEXO" type="radio" value="M" checked/>
            <label for="radioMasculino">Masculino</label>
        </div>
        <div class="col-xs-6">
            <input id="radioFemenino" name="SEXO" type="radio" value="F"/>
            <label for="radioFemenino">Femenino</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <label for="USUARIO">Usuario</label>
            <input name="USUARIO" type="text" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-6">
            <label for="PASSWORD">Password</label>
            <input name="PASSWORD" type="password" class="form-control">
        </div>
    </div>
</form>