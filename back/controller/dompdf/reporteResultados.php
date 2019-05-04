<?php

include_once realpath('../../facade/Registro_votoFacade.php');
include_once realpath('../../facade/Otros_votosFacade.php');

$fecha = $_POST['fecha'];
$list=Registro_votoFacade::listResultados($fecha);
$accionestotales = Registro_votoFacade::countacciones($fecha);
$otros = Otros_votosFacade::listResultados($fecha);

require_once 'autoload.inc.php';
use Dompdf\Dompdf;

$content = '<html>';
$content .= '<head><meta charset="UTF-8"><title>Resultados de Votaciones '.$fecha.'</title></head>';
$content .= '<body><h1 style="text-align:center; font-size:20px">Resultados de Votaciones '.$fecha.'</h1>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="margin: 0 auto"><thead style="font-size:16px; text-align:center" ><tr><th>Plancha</th><th>Acciones a favor</th></tr></thead>';
$content .= '<tbody>';
$total = 0;
foreach ($list as $obj => $resultado) {	
	$content .= '<tr><td style="text-align:center;">'.$resultado->getlista().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getvotos().'</td></tr>';
	$total += $resultado->getvotos();
}
$content .= '<tr><td style="font-size:13px; text-align:center">Voto en Blanco</td>';
$content .= '<td style="text-align:center;">'.($accionestotales->getvotos()-$total).'</td></tr>';
$content .= '<tr><td style="font-size:14px; text-align:center"><b>Total</b></td>';
$content .= '<td style="text-align:center;">'.$accionestotales->getvotos().'</td></tr>';
$content .= '</tbody></table><br><br><br><br>';

$content .= '<h3 style="text-align:center; font-size:18px">Resultados de Otras Votaciones</h3>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="margin: 0 auto"><thead style="font-size:16px; text-align:center"><tr>';
$content .= '<th>Nombre</th><th>Votos Si</th><th>Votos No</th></tr></thead>';
$content .= '<tbody>';

foreach ($list as $obj => $resultado) {	
	$content .= '<tr><td style="text-align:center;">'.$resultado->getnombre().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getvotos().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getvotosno().'</td></tr>';
}

$content .= '<tr><td colspan="2" style="font-size:13px; text-align:center">Voto en Blanco</td>';
$content .= '<td style="text-align:center;">'.($accionestotales->getvotos()-$resultado->getvotos()-$resultado->getvotosno()).'</td></tr>';
$content .= '<tr><td colspan="2" style="font-size:14px; text-align:center"><b>Total</b></td>';
$content .= '<td style="text-align:center;">'.$accionestotales->getvotos().'</td></tr>';
$content .= '</tbody></table></body></html>';

//echo $content;exit;

$dompdf = new Dompdf();
$dompdf->loadHtml(utf8_decode($content));
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("pdfs/reporteResultados.pdf", $pdf);

?>
