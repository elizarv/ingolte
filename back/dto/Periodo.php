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
  private $esrepresentante;
  private $representante_cc;

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
  public function getEsrepresentante(){
      return $this->esrepresentante;
  }

    /**
     * Modifica el valor correspondiente a esrepresentante
     * @param esrepresentante
     */
  public function setEsrepresentante($esrepresentante){
      $this->esrepresentante = $esrepresentante;
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


}
//That´s all folks!