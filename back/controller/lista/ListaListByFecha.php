<?php

include_once realpath('../../facade/ListaFacade.php');

$fecha = Date("Y");
$list=ListaFacade::listByFecha($fecha);
$rta="";
foreach ($list as $obj => $Lista) {	
	$rta.="{
 	    \"fecha\":\"{$Lista->getfecha()}\",
	    \"numero\":\"{$Lista->getnumero()}\"
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