<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Bastará decir que soy Juan Pablo Castel, el pintor que mató a María Iribarne...  \\
include_once realpath('../../facade/PeriodoFacade.php');

$numero= $_POST['numero'];
PeriodoFacade::deleteconsecutivo($numero);

echo "true";

//That´s all folks!