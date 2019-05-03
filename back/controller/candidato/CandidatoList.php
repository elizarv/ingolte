<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Se buscan memeros profesionales. Contacto: El benévolo señor Arciniegas  \\
include_once realpath('../../facade/CandidatoFacade.php');

$list=CandidatoFacade::listAll();
$rta="";
foreach ($list as $obj => $Candidato) {	
	$rta.="{
 	    \"nombre\":\"{$Candidato->getnombre()}\",
	    \"cedula\":\"{$Candidato->getcedula()}\",
	    \"numero\":\"{$Candidato->getnumero()}\",
	    \"fecha\":\"{$Candidato->getfecha()}\",
	    \"numerocandidato\":\"{$Candidato->getnumerocandidato()}\"
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