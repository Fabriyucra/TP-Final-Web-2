<?php
session_start();
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");
$db = new DBManager();

$db->bajaViaje($_POST["id"]);