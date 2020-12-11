<?php
session_start();
require_once("../../../config/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$dato = $_POST["id"];

$db->bajaMantenimiento($dato);