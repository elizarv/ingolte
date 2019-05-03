<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ...Y como plato principal: ¡Código espagueti!  \\
include_once realpath('../../facade/CandidatoFacade.php');
include_once realpath('../../facade/ListaFacade.php');


$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
$fecha = Date("Y");

$lista = ListaFacade::select($fecha, $numero);
if($lista->getfecha() == "" && $lista->getnumero() == 0){
	ListaFacade::insert($fecha, $numero);
}

$cuenta = CandidatoFacade::countnumero($fecha, $numero);

CandidatoFacade::insert($fecha, $nombre, $cedula, $numero, $cuenta+1);
echo "true";

//That´s all folks!