<?php

include_once realpath('../../facade/PeriodoFacade.php');

$fecha = $_POST['fecha'];

$Periodo=PeriodoFacade::selectByFecha($fecha);

$rta="";
	$rta.="{
 	    \"fecha\":\"{$Periodo->getfecha()}\",
	    \"cedula\":\"{$Periodo->getcedula()}\"
	},";

if($Periodo->getcedula()!=""){
	$rta = substr($rta, 0, -1);
	$msg="{\"msg\":\"exito\"}";
}else{
	$msg="{\"msg\":\"Error\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}

echo "[{$msg},{$rta}]";