<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    El coronel necesitó setenta y cinco años -los setenta y cinco años de su vida, minuto a minuto- para llegar a ese instante. Se sintió puro, explícito, invencible, en el momento de responder:  \\

include_once realpath('../../dao/interfaz/IListaDao.php');
include_once realpath('../../dto/Lista.php');

class ListaDao implements IListaDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Lista en la base de datos.
     * @param lista objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($lista){
      $fecha=$lista->getFecha();
$numero=$lista->getNumero();

      try {
          $sql= "INSERT INTO `lista`( `fecha`, `numero`)"
          ."VALUES ('$fecha','$numero')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($lista){
      $fecha=$lista->getFecha();
      $numero=$lista->getNumero();

      try {
          $sql= "SELECT `fecha`, `numero`"
          ."FROM `lista`"
          ."WHERE `fecha`='$fecha' AND`numero`='$numero'";
          $data = $this->ejecutarConsulta($sql);
          $lista = new Lista();
          for ($i=0; $i < count($data) ; $i++) {
          $lista->setFecha($data[$i]['fecha']);
          $lista->setNumero($data[$i]['numero']);
          }
      return $lista;      
    } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Lista en la base de datos.
     * @param lista objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($lista){
      $fecha=$lista->getFecha();
$numero=$lista->getNumero();

      try {
          $sql= "UPDATE `lista` SET`fecha`='$fecha' ,`numero`='$numero' WHERE `fecha`='$fecha' AND `numero`='$numero' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($lista){
      $fecha=$lista->getFecha();
$numero=$lista->getNumero();

      try {
          $sql ="DELETE FROM `lista` WHERE `fecha`='$fecha' AND`numero`='$numero'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Lista en la base de datos.
     * @return ArrayList<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `fecha`, `numero`"
          ."FROM `lista`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $lista= new Lista();
          $lista->setFecha($data[$i]['fecha']);
          $lista->setNumero($data[$i]['numero']);

          array_push($lista,$lista);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($lista){
      $lista = array();
      $fecha=$lista->getFecha();

      try {
          $sql ="SELECT `fecha`, `numero`"
          ."FROM `lista`"
          ."WHERE `fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $lista = new Lista();
          $lista->setFecha($data[$i]['fecha']);
          $lista->setNumero($data[$i]['numero']);

          array_push($lista,$lista);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByNumero($lista){
      $lista = array();
      $numero=$lista->getNumero();

      try {
          $sql ="SELECT `fecha`, `numero`"
          ."FROM `lista`"
          ."WHERE `numero`='$numero'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $lista = new Lista();
          $lista->setFecha($data[$i]['fecha']);
          $lista->setNumero($data[$i]['numero']);

          array_push($lista,$lista);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
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
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close(){
      $cn=null;
  }
}
//That´s all folks!