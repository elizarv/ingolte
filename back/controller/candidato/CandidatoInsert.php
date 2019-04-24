<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ...Y como plato principal: ¡Código espagueti!  \\
include_once realpath('../../facade/CandidatoFacade.php');

$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
CandidatoFacade::insert($nombre, $cedula, $numero);
echo "true";

//That´s all folks!