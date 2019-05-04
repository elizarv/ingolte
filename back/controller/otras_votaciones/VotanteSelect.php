<?php

include_once realpath('../../facade/Registro_votoFacade.php');
include_once realpath('../../facade/AccionistasFacade.php');
include_once realpath('../../facade/Otros_votosFacade.php');

$fecha = Date("Y");
$cedula = $_POST['cc'];

$registro=Registro_votoFacade::select($cedula, $fecha);

if($registro->getcedula()==''){
	$msg="{\"msg\":\"Error\"}";
	$rta="{\"result\":\"No se encontraron registros.\"}";	
}else{

	$voto = Otros_votosFacade::select($cedula, $fecha);

	if($voto->getcedula()!=''){
		$msg="{\"msg\":\"Ya\"}";
		$rta="{\"result\":\"Ya voto\"}";	
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
}
echo "[{$msg},{$rta}]";