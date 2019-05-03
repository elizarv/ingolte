<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    They call me Mr. Espagueti  \\


class Otras_votaciones {

  private $fecha;
  private $id;
  private $nombre;

    /**
     * Constructor de Otros_votos
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a cedula
     * @return cedula
     */
  public function getnombre(){
      return $this->nombre;
  }

    /**
     * Modifica el valor correspondiente a cedula
     * @param cedula
     */
  public function setnombre($nombre){
      $this->nombre = $nombre;
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
   
}
//That´s all folks!