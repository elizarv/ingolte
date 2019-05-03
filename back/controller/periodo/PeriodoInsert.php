<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Bastará decir que soy Juan Pablo Castel, el pintor que mató a María Iribarne...  \\
include_once realpath('../../facade/PeriodoFacade.php');

$Accionistas_cedula= $_POST['cc_acc'];
$accionistas= new Accionistas();
$accionistas->setCedula($Accionistas_cedula);
$representante_cc = $_POST['cc_rep'];
$num_radicado = $_POST['num_radicado'];
$rta = PeriodoFacade::insert($accionistas, $representante_cc, $num_radicado);
if((string)$rta == "Update") echo "update";exit;
if((string)$rta != "Error")$rta = "true";
echo (string)$rta;

//That´s all folks!