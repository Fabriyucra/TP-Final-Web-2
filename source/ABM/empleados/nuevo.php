<?php
session_start();
/**
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
$db = new DBManager();
$db->altaEmpleado($_POST);
 **/

require_once "../../../helper/config.php";
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$estado = 1;
$pass = md5($_POST["PASSWORD"]);

$nombre= $_POST["NOMBRE"];
$apellido=$_POST["APELLIDO"];
$dni=$_POST["DNI"];
$sexo=$_POST["SEXO"];
$fecha_nacimiento=$_POST["FECHA_NACIMIENTO"];
$fecha_ingreso=$_POST["FECHA_INGRESO"];
$sueldo=$_POST["SUELDO"];
$usuario=$_POST["USUARIO"];
$id_rol=$_POST["ROL"];
$avatar=$_POST["AVATAR"];

    $sql = "insert into EMPLEADO
			(NOMBRE,
			APELLIDO,
			DNI,
			SEXO,
			FECHA_NACIMIENTO,
			FECHA_INGRESO,
			SUELDO,
			USUARIO,
			PASSWORD,
			ID_ROL,
			ACTIVO,
			AVATAR)
			values( '$nombre',
                    '$apellido',
                    '$dni',
                    '$sexo',
                    '$fecha_nacimiento',
                    '$fecha_ingreso',
                    '$sueldo',
                    '$usuario',
                    '$pass',
                    '$id_rol',
                    '$estado',
                    '$avatar')
		";

    $resultado = $conexion->query($sql);

    if ($conexion->errno) {
        echo "Error al subir";
    } else {
        echo "Registrado exitosamente";
        echo $conexion->affected_rows;
    }
?>