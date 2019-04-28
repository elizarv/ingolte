<?php

class Poder {

  private $cedula;
  private $nombre;
  private $acciones;
  private $poderdantes;

    /**
     * Constructor de Registro_voto
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a cedula
     * @return cedula
     */
  public function getCedula(){
      return $this->cedula;
  }

    /**
     * Modifica el valor correspondiente a cedula
     * @param cedula
     */
  public function setCedula($cedula){
      $this->cedula = $cedula;
  }
    /**
     * Devuelve el valor correspondiente a fecha
     * @return fecha
     */
  public function getnombre(){
      return $this->nombre;
  }

    /**
     * Modifica el valor correspondiente a fecha
     * @param fecha
     */
  public function setnombre($n){
      $this->nombre = $n;
  }
  
  public function getacciones(){
    return $this->acciones;
  }

  public function setacciones($n){
      $this->acciones = $n;
  }


  public function getpoderdantes(){
    return $this->poderdantes;
  }

  public function setpoderdantes($n){
      $this->poderdantes = $n;
  }

}
//That´s all folks!