<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Únicamente cuando se pierde todo somos libres para actuar.  \\
include_once realpath('../../facade/Registro_votoFacade.php');
include_once realpath('../../facade/PeriodoFacade.php');

$cedula = $_POST['cc'];
$fecha = Date("Y");
$periodo = PeriodoFacade::select($cedula, $fecha);
$valido = '1';
if($periodo->getcedula()!=""){
	if($periodo->getvalido()=='1'){
		echo "ya";
		exit;
	}else{
		PeriodoFacade::update($cedula, $fecha, $valido);
		if($registro->getcedula()==""){
			Registro_votoFacade::insert($cedula);
		}
		echo "update";
		exit;
	}
}
$registro = Registro_votoFacade::select($cedula, $fecha);
if($registro->getcedula()==""){
	Registro_votoFacade::insert($cedula);
	echo "true";
	exit;
}else{
	echo "ya";
	exit;
}

//That´s all folks!