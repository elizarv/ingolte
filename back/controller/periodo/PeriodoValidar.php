<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Bastará decir que soy Juan Pablo Castel, el pintor que mató a María Iribarne...  \\
include_once realpath('../../dao/PeriodoDao.php');

$rta = PeriodoDao::validar();

if($rta== "Update"){
	echo "update";
	exit;
}
if((string)$rta != "Error")$rta = "true";
echo (string)$rta;

//That´s all folks!