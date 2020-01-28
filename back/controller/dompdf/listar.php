<?php

include_once realpath('../../facade/PeriodoFacade.php');
include_once realpath('../../facade/AccionistasFacade.php');

$list = AccionistasFacade::listAll();

require_once 'autoload.inc.php';
use Dompdf\Dompdf;

$content = '<html>';
$content .= '<head><meta charset="UTF-8"><title>Listado de Accionistas</title></head>';
$content .= '<body><h1 style="text-align:center; font-size:20px">Listado de Accionistas</h1>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="font-size:12px"><thead style="font-size:13px; text-align:center" ><tr><th>Nombre</th><th>Cedula</th><th>Acciones representadas</th></tr></thead>';
$content .= '<tbody>';

$tot_acc = 0;

foreach ($list as $obj => $accionista) {	
	$content .= '<tr><td>';
	$content .= ($accionista->getnombre()).'</td>';
	$content .= '<td>';
	$content .= ($accionista->getcedula()).'</td>';
	$content .= '<td>';
	$content .= ($accionista->getacciones()).'</td>';
	$content .= '</td>';
	$tot_acc += $accionista->getacciones();
}

$content .= '<tr><td colspan="2" style="font-size:16px; text-align:center"><b>Total</b></td><td style="text-align:center;"></td><td style="text-align:center;">'.$tot_acc.'</td></tr>';
$content .= '</tbody></table>';

$content .= '</body></html>';
//echo $content;exit;

$dompdf = new Dompdf();
$dompdf->loadHtml(($content));
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("pdfs/listaAccionistas.pdf", $pdf);

?>
