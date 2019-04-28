<?php
require('fpdf.php');

class PDF extends FPDF
{
    protected $fecha;
    function fecha($fecha){
        $this->fecha = $fecha;
    }
// Cabecera de página
function Header()
{
    // Logo
    //$this->Image('logo_pb.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $titulo= "Listado de Poderes ".$this->fecha;
    $this->Cell(30,10,$titulo,0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this->cell(60, 8, "Apoderado", 1, 0, 'L',0);
    $this->cell(60, 8, "Poderdantes", 1, 0, 'L',0);
    $this->Cell(30, 8, "Acc. Repres.", 1,'L',0);
    $this->Cell(30, 8, "Tot. Acciones", 1, 1,'L',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Output();
?>
