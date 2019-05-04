<?php

include_once realpath('../../facade/Otras_votacionesFacade.php');

$fecha = Date("Y");
$list=Otras_votacionesFacade::listByFecha($fecha);
$rta="";
foreach ($list as $obj => $votacion) {	
	$rta.="{
 	    \"nombre\":\"{$votacion->getnombre()}\",
	    \"id\":\"{$votacion->getId()}\"
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