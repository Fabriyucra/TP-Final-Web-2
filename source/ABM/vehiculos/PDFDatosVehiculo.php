<?php
session_start();
require('../../lib/fpdf/fpdf.php');
require_once("../../../config/DBManager.php");
if (empty($_SESSION['usuario'])) header("Location: login.php");

$db = new DBManager();
//$dato = $_POST["id"];
$vehiculos = $db->obtenerVehiculos();

	class PDF extends FPDF
	{
	// Page header
	function Header()
	{
	    $this->SetFont('Arial','B',15);
	    // Move to the right
	    $this->Cell(50);
	    // Title
		$this->Cell(100,10,'VEHICULOS DE LA EMPRESA',1,0,'C');
	    // Line break
	    $this->Ln(10);

	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	}

	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);


	foreach($vehiculos as $vehiculo):

		
		$pdf->Cell(0,0,'',1,1,'C');
	    $pdf->Cell(0,8,'',0,1);
	    $pdf->Cell(0,8,'PATENTE : ' . $vehiculo["PATENTE"],0,1);
	    $pdf->Cell(0,8,'MODELO : ' . $vehiculo["MODELO"],0,1);
	    $pdf->Cell(0,8,'AÑO : ' . $vehiculo["ANO"],0,1);
		$pdf->Cell(0,8,'MARCA: ' . $vehiculo["MARCA"],0,1);
		$pdf->Cell(0,8,'NRO_CHASIS: ' . $vehiculo["NRO_CHASIS"],0,1);
		$pdf->Cell(0,8,'NRO_MOTOR : ' . $vehiculo["NRO_MOTOR"],0,1);

		$pdf->Ln();
		If ($vehiculo <> end($vehiculos))
			$pdf->Cell(0,0,'',1,1,'C');

	endforeach;

	$pdf->Output();
?>