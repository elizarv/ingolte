<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Sólo relájate y deja que alguien más lo haga  \\
include_once realpath('../../facade/PeriodoFacade.php');

$list=PeriodoFacade::listAll();
$rta="";
foreach ($list as $obj => $Periodo) {	
	$rta.="{
 	    \"cedula\":\"{$Periodo->getcedula()}\",
	    \"ccrepre\":\"{$Periodo->getcedula2()}\",
	    \"nombre\":\"{$Periodo->getnombre()}\",
	    \"repre\":\"{$Periodo->getnombre2()}\",
	    \"num\":\"{$Periodo->getnumradicado()}\"
	},";
}
if($rta!=""){
	$rta = substr($rta, 0, -1);
	$msg="{\"msg\":\"exito\"}";
}else{
	$msg="{\"msg\":\"MANEJO DE EXCEPCIONES AQUÍ\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}

echo "[{$msg},{$rta}]";

//That´s all folks!