<?php
session_start();
include '../../database/DBManager.php';
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
$db = new DBManager();
$dato = $_POST["id"];

$db->marcarMantenimientoRealizado($dato);