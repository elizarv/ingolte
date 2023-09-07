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
if($periodo->getcedula()!=""){ // existe un poder para este accionista
	if($periodo->getvalido()=='1'){ // se informa que el accionista ya esta registrado como asistente
		echo "ya";
		exit;
	}else{ // el apoderado ya se registro, se actualiza el poder, se elimina del apoderado y se registra el accionista como asistente
		PeriodoFacade::update($cedula, $fecha, $valido);
		$registro = Registro_votoFacade::select($cedula, $fecha);
		if($registro->getcedula()==""){ 
			Registro_votoFacade::insert($cedula);
		}
		echo "update";
		exit;
	}
}
// no existe poder relacionado
$registro = Registro_votoFacade::select($cedula, $fecha);
if($registro->getcedula()=="no"){ // no tiene acciones a cargo, no se puede registrar
	echo "no";
	exit;
}
if($registro->getcedula()==""){ // se registra el usuario, en caso de tener poderes se registran todos los poderdantes
	Registro_votoFacade::insert($cedula);
	echo "true";
	exit;
}else{ // se informa que ya se encuentra registrado
	echo "ya";
	exit;
}

//That´s all folks!