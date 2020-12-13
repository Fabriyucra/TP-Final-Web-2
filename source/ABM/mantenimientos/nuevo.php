<?php
session_start();
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
/*
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$db->altaMantenimiento($_POST);
*/

require_once "../../../helper/config.php";
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$dominio_vehiculo= $_POST["DOMINIO"];
$fecha=$_POST["MODELO"];
$km_vehiculo=$_POST["MARCA"];
$costo=$_POST["ANO"];
$empleado_encargado=$_POST["NRO_CHASIS"];
$comentario=$_POST["NRO_MOTOR"];


$sql = "insert into SERVICE (DOMINIO_VEHICULO, FECHA, KM_VEHICULO, COSTO,
				EMPLEADO_ENCARGADO, COMENTARIO)
			values('$dominio_vehiculo', '$fecha', '$km_vehiculo', '$costo',
				'$empleado_encargado', '$comentario')";

$resultado = $conexion->query($sql);

if ($conexion->errno) {
    echo "Error al subir";
} else {
    echo "Registrado exitosamente";
    echo $conexion->affected_rows;
}
?>