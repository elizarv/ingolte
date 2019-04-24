<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Sólo relájate y deja que alguien más lo haga  \\
include_once realpath('../../facade/PeriodoFacade.php');

$list=PeriodoFacade::listAll();
$rta="";
foreach ($list as $obj => $Periodo) {	
	$rta.="<tr>\n";
	$rta.="<td>".$Periodo->getfecha()."</td>\n";
	$rta.="<td>".$Periodo->getcedula()->getcedula()."</td>\n";
	$rta.="<td>".$Periodo->getesrepresentante()."</td>\n";
	$rta.="<td>".$Periodo->getrepresentante_cc()."</td>\n";
	$rta.="</tr>\n";
}
echo $rta;

//That´s all folks!