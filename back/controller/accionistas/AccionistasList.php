<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    El gran hermano te vigila  \\
include_once realpath('../../facade/AccionistasFacade.php');

$rta = "";
$list=AccionistasFacade::listAll();
foreach ($list as $obj => $Accionistas) {	
	$rta.="{\"{$Accionistas->getcedula()}\":{
 	    \"cedula\":\"{$Accionistas->getcedula()}\",
	    \"apellidos\":\"{$Accionistas->getapellidos()}\",
	    \"nombre\":\"{$Accionistas->getnombre()}\",
	    \"acciones\":\"{$Accionistas->getacciones()}\"
	}},";
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