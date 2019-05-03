<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Quédate con quien te quiera por tu back-end, no por tu front-end  \\
include_once realpath('../../facade/Otros_votosFacade.php');

$list=Otros_votosFacade::listAll();
$rta="";
foreach ($list as $obj => $Otros_votos) {	
	$rta.="{
 	    \"cedula\":\"{$Otros_votos->getcedula()}\",
	    \"fecha\":\"{$Otros_votos->getfecha()}\",
	    \"id\":\"{$Otros_votos->getid()}\",
	    \"voto\":\"{$Otros_votos->getvoto()}\"
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