<?php

include_once realpath('../../facade/Otras_votacionesFacade.php');

$list=Otras_votacionesFacade::listAll();
$rta="";
foreach ($list as $obj => $votacion) {	
	$rta.="{
 	    \"nombre\":\"{$votacion->getnombre()}\",
	    \"fecha\":\"{$votacion->getfecha()}\"
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