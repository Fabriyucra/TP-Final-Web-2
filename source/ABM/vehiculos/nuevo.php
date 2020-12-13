<?php
session_start();
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
/*
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$datos = $_POST;
$db->altaVehiculo($datos);

*/
require_once "../../../helper/config.php";
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$patente= $_POST["DOMINIO"];
$modelo=$_POST["MODELO"];
$marca=$_POST["MARCA"];
$ano=$_POST["ANO"];
$nro_chasis=$_POST["NRO_CHASIS"];
$nro_motor=$_POST["NRO_MOTOR"];
$avatar=$_POST["AVATAR"];
//$estado = 1;

$sql = "insert into VEHICULO (PATENTE, MODELO, ANO, MARCA,NRO_CHASIS, NRO_MOTOR, AVATAR)
			values('$patente', '$modelo','$ano','$marca','$nro_chasis','$nro_motor','$avatar')";

$resultado = $conexion->query($sql);

if ($conexion->errno) {
    echo "Error al subir";
} else {
    echo "Registrado exitosamente";
    echo $conexion->affected_rows;
}
?>