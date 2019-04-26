<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Yo tengo un sueño. El sueño de que mis hijos vivan en un mundo con un único lenguaje de programación.  \\


class Periodo {

  private $fecha;
  private $cedula;
  private $num_radicado;
  private $representante_cc;
  private $cedula2;
  private $nombre;
  private $nombre2;

    /**
     * Constructor de Periodo
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a fecha
     * @return fecha
     */
  public function getFecha(){
      return $this->fecha;
  }

    /**
     * Modifica el valor correspondiente a fecha
     * @param fecha
     */
  public function setFecha($fecha){
      $this->fecha = $fecha;
  }
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
     * Devuelve el valor correspondiente a esrepresentante
     * @return esrepresentante
     */
  public function getnumradicado(){
      return $this->num_radicado;
  }

    /**
     * Modifica el valor correspondiente a esrepresentante
     * @param esrepresentante
     */
  public function setnumradicado($num){
      $this->num_radicado = $num;
  }
    /**
     * Devuelve el valor correspondiente a representante_cc
     * @return representante_cc
     */
  public function getRepresentante_cc(){
      return $this->representante_cc;
  }

    /**
     * Modifica el valor correspondiente a representante_cc
     * @param representante_cc
     */
  public function setRepresentante_cc($representante_cc){
      $this->representante_cc = $representante_cc;
  }

  public function getnombre(){
      return $this->nombre;
  }

  public function setnombre($n){
      $this->nombre = $n;
  }

  public function getnombre2(){
      return $this->nombre2;
  }

  public function setnombre2($n){
      $this->nombre2 = $n;
  }

  public function getcedula2(){
      return $this->cedula2;
  }

  public function setcedula2($n){
      $this->cedula2 = $n;
  }

}
//That´s all folks!