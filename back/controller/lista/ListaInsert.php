<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Cansado de escribir bugs? tranquilo, los escribimos por ti  \\
include_once realpath('../../facade/ListaFacade.php');

$fecha = $_POST['fecha'];
$numero = $_POST['numero'];
ListaFacade::insert($fecha, $numero);
echo "true";

//That´s all folks!