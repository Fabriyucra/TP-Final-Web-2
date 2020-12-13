<?php
session_start();
require_once("../../../helper/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$db->altaProforma($_POST);
