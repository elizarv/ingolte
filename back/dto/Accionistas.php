<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Cansado de escribir bugs? tranquilo, los escribimos por ti  \\


class Accionistas {

  private $cedula;
  private $nombre;
  private $apellidos;
  private $acciones;
  private $email;
  private $telefono;
  private $direccion;

    /**
     * Constructor de Accionistas
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
     * Devuelve el valor correspondiente a apellidos
     * @return apellidos
     */
  public function getApellidos(){
      return $this->apellidos;
  }

    /**
     * Modifica el valor correspondiente a apellidos
     * @param apellidos
     */
  public function setApellidos($apellidos){
      $this->apellidos = $apellidos;
  }
    /**
     * Devuelve el valor correspondiente a acciones
     * @return acciones
     */
  public function getAcciones(){
      return $this->acciones;
  }

    /**
     * Modifica el valor correspondiente a acciones
     * @param acciones
     */
  public function setAcciones($acciones){
      $this->acciones = $acciones;
  }

  public function getEmail(){
    return $this->email;
  }

  public function setEmail($x){
      $this->email = $x;
  }

  public function getTelefono(){
    return $this->telefono;
  }

  public function setTelefono($x){
      $this->telefono = $x;
  }

  public function getDireccion(){
    return $this->direccion;
  }

  public function setDireccion($x){
      $this->direccion = $x;
  }


}
//That´s all folks!