<?php

class Resultados {

  private $lista;
  private $votos;
  private $nombre;
  private $votosno;
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

  public function getnombre(){
    return $this->nombre;
  }

  public function setnombre($n){
    $this->nombre = $n;
  }

  public function getvotosno(){
      return $this->votosno;
  }

    /**
     * Modifica el valor correspondiente a fecha
     * @param fecha
     */
  public function setvotosno($n){
      $this->votosno = $n;
  }
  
}
//That´s all folks!