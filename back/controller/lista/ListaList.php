<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Alguna vez Anarchy se llamó Molotov ( u.u) *Nostalgia  \\
include_once realpath('../../facade/ListaFacade.php');

$list=ListaFacade::listAll();
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