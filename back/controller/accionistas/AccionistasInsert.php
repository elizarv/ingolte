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
$acciones = $_POST['acciones'];
AccionistasFacade::insert($cedula, $nombre, $acciones);
echo "true";

//That´s all folks!