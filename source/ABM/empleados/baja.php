<?php
session_start();
require_once("../../../helper/DBManager.php");
$db = new DBManager();
$dato = $_POST["id"];

$db->bajaEmpleado($dato);