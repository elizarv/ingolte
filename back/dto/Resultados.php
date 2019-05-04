<?php

class Resultados {

  private $lista;
  private $votos;
    /**
     * Constructor de Registro_voto
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a cedula
     * @return cedula
     */
  public function getlista(){
      return $this->lista;
  }

    /**
     * Modifica el valor correspondiente a cedula
     * @param cedula
     */
  public function setlista($n){
      $this->lista = $n;
  }
    /**
     * Devuelve el valor correspondiente a fecha
     * @return fecha
     */
  public function getvotos(){
      return $this->votos;
  }

    /**
     * Modifica el valor correspondiente a fecha
     * @param fecha
     */
  public function setvotos($n){
      $this->votos = $n;
  }
  
}
//That´s all folks!