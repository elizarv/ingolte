<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Únicamente cuando se pierde todo somos libres para actuar.  \\
include_once realpath('../../facade/Registro_votoFacade.php');

$cedula = $_POST['cc'];
Registro_votoFacade::insert($cedula);
echo "true";

//That´s all folks!