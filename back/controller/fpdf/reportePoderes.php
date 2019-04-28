<?php

include_once realpath('../../facade/PeriodoFacade.php');
$fecha = $_POST['fecha'];
$list=PeriodoFacade::listPoderes($fecha);

require('pdfClass.php');
$pdf = new PDF();
$pdf->fecha($fecha);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',8);
$x1 = $pdf->GetX();
$y1 = $pdf->GetY();
$x2 = $x1+180;
foreach ($list as $obj => $poder) {	
	$y = $pdf->getY();
	$x = $pdf->getX()+60;
	$apoderado = $poder->getnombre()." (".$poder->getacciones().")";
	$pdf->MultiCell(60, 4, $apoderado, 0, 'L',0);
	$pdf->SetY($y);
	$pdf->SetX($x);
	$accionistas = "";
	$y = $pdf->GetY();
	$total = 0;
	foreach($poder->getpoderdantes() as $obj => $accionista){
		 $accionistas.= $accionista->getnombre();
		 $accionistas.=" (".$accionista->getacciones().")\n" ;
		 $total += $accionista->getacciones();
	}
	$x = $pdf->GetX()+60;
	$pdf->MultiCell(60, 4, $accionistas, 0,'L', 0);
	$y2 = $pdf->GetY();
	$pdf->SetY($y);
	$pdf->SetX($x);
	$pdf->Cell(30, 4, $total, 0, 0,'C', 0);
	$pdf->Cell(30, 4, $total+$poder->getacciones(), 0, 1, 'C', 0);
	$pdf->SetY($y2);
	$pdf->ln();
	$pdf->line($x1, $pdf->GetY(), $x2, $pdf->GetY());
	$pdf->line($x1, $y1, $x1, $pdf->GetY());
	$pdf->line($x1+60, $y1, $x1+60, $pdf->GetY());
	$pdf->line($x1+120, $y1, $x1+120, $pdf->GetY());
	$pdf->line($x1+150, $y1, $x1+150, $pdf->GetY());
	$pdf->line($x2, $y1, $x2, $pdf->GetY());
	$y1 = $pdf->GetY();
}
$pdf->Output("pdf/reportePoderes.pdf", "F");

?>