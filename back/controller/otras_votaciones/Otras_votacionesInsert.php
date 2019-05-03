<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Cuando eres Ingeniero en sistemas, pero tu vocación siempre fueron los memes  \\
include_once realpath('../../facade/Otras_votacionesFacade.php');

$nombre = strip_tags($_POST['nombre']);
$fecha = Date("Y");
Otras_votacionesFacade::insert($nombre, $fecha);
echo "true";

//That´s all folks!