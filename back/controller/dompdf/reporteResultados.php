<?php

include_once realpath('../../facade/Registro_votoFacade.php');
include_once realpath('../../facade/Otros_votosFacade.php');
include_once realpath('../../facade/CandidatoFacade.php');
include_once realpath('../../dto/ganadores.php');

$fecha = $_POST['fecha'];
$list=Registro_votoFacade::listResultados($fecha);
$accionestotales = Registro_votoFacade::countacciones($fecha);
$otros = Otros_votosFacade::listResultados($fecha);

$array = array();

require_once 'autoload.inc.php';
use Dompdf\Dompdf;

$content = '<html>';
$content .= '<head><meta charset="UTF-8"><title>Resultados de Votaciones '.$fecha.'</title></head>';
$content .= '<body><h1 style="text-align:center; font-size:20px">Resultados de Votaciones '.$fecha.'</h1>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="margin: 0 auto"><thead style="font-size:16px; text-align:center" ><tr><th>Plancha</th><th>Acciones a favor</th></tr></thead>';
$content .= '<tbody>';
$total = 0;
$votosblanco;
foreach ($list as $obj => $resultado) {	
	if($resultado->getlista() == '0'){
		$votosblanco = $resultado->getvotos();
	}else{
		$content .= '<tr><td style="text-align:center;">'.$resultado->getlista().'</td>';
		$content .= '<td style="text-align:center;">'.$resultado->getvotos().'</td></tr>';
	}
	$total += $resultado->getvotos();
	$ganador = new Ganador();
	$ganador->setnumero($resultado->getlista());
	$ganador->setvotos($resultado->getvotos());
	if($resultado->getlista()!='0')array_push($array,$ganador);
}
$content .= '<tr><td style="font-size:13px; text-align:center">Votos en Blanco</td>';
$content .= '<td style="text-align:center;">'.($votosblanco).'</td></tr>';
$content .= '<tr><td style="font-size:13px; text-align:center">Sin votar</td>';
$content .= '<td style="text-align:center;">'.($accionestotales->getvotos()-$total).'</td></tr>';
$content .= '<tr><td style="font-size:14px; text-align:center"><b>Total</b></td>';
$content .= '<td style="text-align:center;">'.$accionestotales->getvotos().'</td></tr>';
$content .= '</tbody></table><br><br><br>';



//BUSCAR GANADORES
$cociente = $accionestotales->getvotos()/5;
arsort($array);
$ganadores = array();

while(sizeof($ganadores)<5){
	foreach ($array as $key => $val) {
		array_push($ganadores, $val->getnumero());		
		$val->setvotos($val->getvotos()-$cociente);
		arsort($array);
	    break;
	}
}
sort($ganadores);
$numact = 0;
$ind = 0;
$nombresganadores = array();

foreach ($ganadores as $key => $val) {
	if($numact != $val){
		$numact = $val;
		$ind = 1;
		$candidatos = CandidatoFacade::select($numact, $fecha, $ind);
		array_push($nombresganadores, $candidatos);
	}else{
		$ind++;
		$candidatos = CandidatoFacade::select($numact, $fecha, $ind);
		array_push($nombresganadores, $candidatos);		
	}
}
//FIN BUSCAR GANADORES
$content .= '<h3 style="text-align:center; font-size:18px">Ganadores</h3>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="margin: 0 auto"><thead style="font-size:16px; text-align:center"><tr>';
$content .= '<th>Nombre</th><th>Cedula</th><th>Plancha</th></tr></thead>';
$content .= '<tbody>';


foreach ($nombresganadores as $key => $val) {
	$content .= '<tr><td style="text-align:center;">'.$val->getnombre().'</td>';
	$content .= '<td style="text-align:center;">'.$val->getcedula().'</td>';
	$content .= '<td style="text-align:center;">'.$val->getnumero().'</td></td>';
}
$content.= '</tbody></table><br><br><br>';


$content .= '<h3 style="text-align:center; font-size:18px">Resultados de Otras Votaciones</h3>';
$content .= '<table border=1 cellspacing=0 cellpadding=2 style="margin: 0 auto"><thead style="font-size:16px; text-align:center"><tr>';
$content .= '<th>Nombre</th><th>Votos Si</th><th>Votos No</th><th>Votos en blanco</th><th>Sin votar</th><th>Total</th></tr></thead>';
$content .= '<tbody>';

foreach ($otros as $obj => $resultado) {	
	$content .= '<tr><td style="text-align:center;">'.$resultado->getnombre().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getvotos().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getvotosno().'</td>';
	$content .= '<td style="text-align:center;">'.$resultado->getblancos().'</td>';
	$tot = ($accionestotales->getvotos()-$resultado->getblancos()-$resultado->getvotosno()-$resultado->getvotos());
	$content .= '<td style="text-align:center;">'.$tot.'</td>';
	$content .= '<td style="text-align:center;">'.$accionestotales->getvotos().'</td></tr>';
}

$content .= '</tbody></table></body></html>';

//echo $content;exit;

$dompdf = new Dompdf();
$dompdf->loadHtml(utf8_decode($content));
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("pdfs/reporteResultados.pdf", $pdf);

?>
