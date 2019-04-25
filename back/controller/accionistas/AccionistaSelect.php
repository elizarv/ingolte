<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    El gran hermano te vigila  \\
include_once realpath('../../facade/AccionistasFacade.php');

$cc = $_POST['cedula'];

$Accionista=AccionistasFacade::select($cc);
$rta="";
	$rta.="{
 	    \"cedula\":\"{$Accionista->getcedula()}\",
	    \"nombre\":\"{$Accionista->getnombre()}\",
	    \"acciones\":\"{$Accionista->getacciones()}\"
	},";



if($Accionista->getnombre()!=""){
	$rta = substr($rta, 0, -1);
	$msg="{\"msg\":\"exito\"}";
}else{
	$msg="{\"msg\":\"MANEJO DE EXCEPCIONES AQUÍ\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}

echo "[{$msg},{$rta}]";

//That´s all folks!