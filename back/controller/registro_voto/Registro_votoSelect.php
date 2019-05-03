<?php

include_once realpath('../../facade/Registro_votoFacade.php');

$fecha = $_POST['fecha'];

$registro=Registro_votoFacade::selectByFecha($fecha);

$rta="";
	$rta.="{
 	    \"fecha\":\"{$registro->getfecha()}\",
	    \"cedula\":\"{$registro->getcedula()}\"
	},";

if($registro->getcedula()!=""){
	$rta = substr($rta, 0, -1);
	$msg="{\"msg\":\"exito\"}";
}else{
	$msg="{\"msg\":\"Error\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}

echo "[{$msg},{$rta}]";