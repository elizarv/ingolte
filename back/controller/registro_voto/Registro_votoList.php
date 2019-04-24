<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Los animales, asombrados, pasaron su mirada del cerdo al hombre, y del hombre al cerdo; y, nuevamente, del cerdo al hombre; pero ya era imposible distinguir quién era uno y quién era otro.  \\
include_once realpath('../../facade/Registro_votoFacade.php');

$list=Registro_votoFacade::listAll();
$rta="";
foreach ($list as $obj => $Registro_voto) {	
	$rta.="{
 	    \"cedula\":\"{$Registro_voto->getcedula()}\",
	    \"fecha\":\"{$Registro_voto->getfecha()}\",
	    \"voto1\":\"{$Registro_voto->getvoto1()}\"
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