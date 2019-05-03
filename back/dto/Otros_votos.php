<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    They call me Mr. Espagueti  \\


class Otros_votos {

  private $cedula;
  private $fecha;
  private $id;
  private $voto;

    /**
     * Constructor de Otros_votos
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
     * Devuelve el valor correspondiente a id
     * @return id
     */
  public function getId(){
      return $this->id;
  }

    /**
     * Modifica el valor correspondiente a id
     * @param id
     */
  public function setId($id){
      $this->id = $id;
  }
    /**
     * Devuelve el valor correspondiente a voto
     * @return voto
     */
  public function getVoto(){
      return $this->voto;
  }

    /**
     * Modifica el valor correspondiente a voto
     * @param voto
     */
  public function setVoto($voto){
      $this->voto = $voto;
  }


}
//That´s all folks!