<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    No quiero morir sin tener cicatrices.  \\


class Lista {

  private $fecha;
  private $numero;
  

    /**
     * Constructor de Lista
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


}
//That´s all folks!