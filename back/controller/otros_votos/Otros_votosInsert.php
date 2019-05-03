<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Cuando eres Ingeniero en sistemas, pero tu vocación siempre fueron los memes  \\
include_once realpath('../../facade/Otros_votosFacade.php');

$cedula = strip_tags($_POST['cedula']);
$fecha = strip_tags($_POST['fecha']);
$id = strip_tags($_POST['id']);
$voto = strip_tags($_POST['voto']);
Otros_votosFacade::insert($cedula, $fecha, $id, $voto);
echo "true";

//That´s all folks!