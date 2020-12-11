<?php
session_start();
require_once("../../../config/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: login.php");
$db = new DBManager();
$db->altaEmpleado($_POST);