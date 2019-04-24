<?php

include_once realpath('../../facade/AccionistasFacade.php');

$list=AccionistasFacade::listVotantes();
$rta="";
foreach ($list as $obj => $Accionistas) {	
	$rta.="{
 	    \"cedula\":\"{$Accionistas->getcedula()}\",
	    \"apellidos\":\"{$Accionistas->getapellidos()}\",
	    \"nombre\":\"{$Accionistas->getnombre()}\",
	    \"acciones\":\"{$Accionistas->getacciones()}\"
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
