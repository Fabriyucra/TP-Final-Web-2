<?php
session_start();
include '../../database/DBManager.php';
if (empty($_SESSION['usuario'])) header("Location: inicio.php");

$db = new DBManager();
$db->altaViaje($_POST);