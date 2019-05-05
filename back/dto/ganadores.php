<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Cansado de escribir bugs? tranquilo, los escribimos por ti  \\


class Ganador {

  
  private $votos;
  private $numero;

  public function getnumero(){
    return $this->numero;
  }

  public function setnumero($n){
    $this->numero = $n;
  }

  public function getvotos(){
    return $this->votos;
  }

  public function setvotos($n){
    $this->votos = $n;
  }

}
//That´s all folks!