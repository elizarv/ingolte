<?php

include_once realpath('../../facade/Registro_votoFacade.php');

$fecha = Date("Y");
$cedula = $_POST['cc'];
$voto = $_POST['numero'];
$registro = Registro_votoFacade::update($cedula, $fecha, $voto);

echo $registro;