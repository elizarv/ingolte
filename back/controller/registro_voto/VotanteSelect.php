<?php

include_once realpath('../../facade/Registro_votoFacade.php');
include_once realpath('../../facade/AccionistasFacade.php');

$fecha = Date("Y");
$cedula = $_POST['cc'];

$registro=Registro_votoFacade::select($cedula, $fecha);

if($registro->getcedula()==''){
	$msg="{\"msg\":\"Error\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}else if($registro->getvoto1()!=''){
	$msg="{\"msg\":\"Ya\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}else{
	$accionista = AccionistasFacade::select($cedula);

	$rta="";
		$rta.="{
	 	    \"nombre\":\"{$accionista->getnombre()}\",
		    \"cedula\":\"{$accionista->getcedula()}\"
		},";

	if($registro->getcedula()!=""){
		$rta = substr($rta, 0, -1);
		$msg="{\"msg\":\"exito\"}";
	}else{
		$msg="{\"msg\":\"Error\"}";
		$rta="{\"result\":\"No se encontraron registros.\"}";	
	}
}
echo "[{$msg},{$rta}]";