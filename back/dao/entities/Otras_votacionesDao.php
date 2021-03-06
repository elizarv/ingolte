<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../../dao/interfaz/IOtras_votacionesDao.php');
include_once realpath('../../dto/Otras_votaciones.php');

class Otras_votacionesDao implements IOtras_votacionesDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }


    public function insert($otras_votaciones){
      $nombre=$otras_votaciones->getnombre();
      $fecha=$otras_votaciones->getFecha();

      try {
          $sql= "INSERT INTO `otras_votaciones`( `nombre`, `fecha`)"
          ."VALUES ('$nombre','$fecha')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

   

      public function insertarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $sentencia = null;
          return $this->cn->lastInsertId();
    }
      public function ejecutarConsulta($sql){
          $this->cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sentencia=$this->cn->prepare($sql);
          $sentencia->execute(); 
          $data = $sentencia->fetchAll();
          $sentencia = null;
          return $data;
    }


    public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `fecha`, `nombre`"
          ."FROM `otras_votaciones`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $votacion= new Otras_votaciones();
          $votacion->setFecha($data[$i]['fecha']);
          $votacion->setnombre($data[$i]['nombre']);
          array_push($lista,$votacion);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listByFecha($fecha){
      $lista = array();
      try {
          $sql ="SELECT `nombre`, id "
          ."FROM `otras_votaciones`"
          ."WHERE fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
            $votacion= new Otras_votaciones();
            $votacion->setnombre($data[$i]['nombre']);
            $votacion->setId($data[$i]['id']);
            array_push($lista,$votacion);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close(){
      $cn=null;
  }
}
//That´s all folks!