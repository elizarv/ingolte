<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¡¡Bienvenido al mundo del mañana!!  \\
include_once realpath('../../facade/AccionistasFacade.php');

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$accionista = AccionistasFacade::select($cedula);
if($accionista->getcedula()!=""){
	echo "Ya";
	exit;
}
AccionistasFacade::insert($cedula, $nombre);
echo "true";

//That´s all folks!