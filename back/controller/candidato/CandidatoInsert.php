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

$lista = ListaFacade::select($numero);

CandidatoFacade::insert($nombre, $cedula, $numero);
echo "true";

//That´s all folks!