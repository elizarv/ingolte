<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Nuestra empresa cuenta con una división sólo para las frases. Disfrútalas  \\


class Candidato {

  private $nombre;
  private $cedula;
  private $numero;
  private $fecha;
  private $numerocandidato;

    /**
     * Constructor de Candidato
    */
     public function __construct(){}

    /**
     * Devuelve el valor correspondiente a nombre
     * @return nombre
     */
  public function getNombre(){
      return $this->nombre;
  }

    /**
     * Modifica el valor correspondiente a nombre
     * @param nombre
     */
  public function setNombre($nombre){
      $this->nombre = $nombre;
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
     * Devuelve el valor correspondiente a numero
     * @return numero
     */
  public function getNumero(){
      return $this->numero;
  }

    /**
     * Modifica el valor correspondiente a numero
     * @param numero
     */
  public function setNumero($numero){
      $this->numero = $numero;
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

  public function getnumerocandidato(){
    return $this->numerocandidato;
  }

  public function setnumerocandidato($n){
    $this->numerocandidato = $n;
  }


}
//That´s all folks!