<?php
session_start();
include '../../database/DBManager.php';
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$datos = $_POST;
$db->editarVehiculo($datos);