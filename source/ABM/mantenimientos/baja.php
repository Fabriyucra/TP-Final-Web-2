<?php
session_start();
include '../../database/DBManager.php';
if (empty($_SESSION['usuario'])) header("Location: login.php");

$db = new DBManager();
$dato = $_POST["id"];

$db->bajaMantenimiento($dato);