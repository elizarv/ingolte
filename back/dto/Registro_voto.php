<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Y si mejor estudias comunicación?  \\


class Registro_voto {

  private $cedula;
  private $fecha;
  private $voto1;

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
     * Devuelve el valor correspondiente a voto1
     * @return voto1
     */
  public function getVoto1(){
      return $this->voto1;
  }

    /**
     * Modifica el valor correspondiente a voto1
     * @param voto1
     */
  public function setVoto1($voto1){
      $this->voto1 = $voto1;
  }


}
//That´s all folks!