<?php

include_once realpath('../../facade/PeriodoFacade.php');
$fecha = $_POST['fecha'];
$list=PeriodoFacade::listPoderes($fecha);

require_once 'autoload.inc.php';
use Dompdf\Dompdf;

$content = '<html>';
$content .= '<head><meta charset="UTF-8"><title>Listado de Poderes '.$fecha.'</title></head>';
$content .= '<body><h1 style="text-align:center; font-size:20px">Listado de Poderes '.$fecha.'</h1>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="font-size:12px"><thead style="font-size:13px; text-align:center" ><tr><th>Apoderado</th><th>Poderdantes</th><th>Acciones representadas</th><th>Acciones totales</th></tr></thead>';
$content .= '<tbody>';
$tot_acc = 0;
$tot_rep = 0;

foreach ($list as $obj => $poder) {	
	$content .= '<tr><td>';
	$content .= utf8_encode($poder->getnombre())." (".$poder->getacciones().")</td>";
	$total = 0;
	$content .= '<td>';
	foreach($poder->getpoderdantes() as $obj => $accionista){
		$content .= utf8_encode($accionista->getnombre());
		$content .=' ('.$accionista->getacciones().')<br>';
		$total += $accionista->getacciones();
	}
	$content .= '</td>';
	$content .= '<td style="text-align:center;">'.$total.'</td>';
	$content .= '<td style="text-align:center;">'.($total+$poder->getacciones()).'</td></tr>';
	$tot_rep += $total;
	$tot_acc += $total + $poder->getacciones();
}
$content .= '<tr><td colspan="2" style="font-size:16px; text-align:center"><b>Total</b></td><td style="text-align:center;">'.$tot_rep.'</td><td style="text-align:center;">'.$tot_acc.'</td></tr>';
$content .= '</tbody></table></body></html>';


//echo $content;exit;

$dompdf = new Dompdf();
$dompdf->loadHtml(utf8_encode($content));
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("pdfs/reportepoderes.pdf", $pdf);

?>
