<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Y pensar que Anarchy está hecho en código espagueti...  \\

include_once realpath('../../dao/interfaz/ICandidatoDao.php');
include_once realpath('../../dto/Candidato.php');

class CandidatoDao implements ICandidatoDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Candidato en la base de datos.
     * @param candidato objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($candidato){
      $nombre=$candidato->getNombre();
      $cedula=$candidato->getCedula();
      $numero=$candidato->getNumero();
      $fecha=$candidato->getFecha();
      $candidatonumero = $candidato->getnumerocandidato();

      try {
          $sql= "INSERT INTO `candidato`( `nombre`, `cedula`, `numero`, `fecha`, numero_candidato)"
          ."VALUES ('$nombre','$cedula','$numero','$fecha', $candidatonumero)";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($candidato){
      $cedula=$candidato->getCedula();
$numero=$candidato->getNumero();
$fecha=$candidato->getFecha();

      try {
          $sql= "SELECT `nombre`, `cedula`, `numero`, `fecha`"
          ."FROM `candidato`"
          ."WHERE `cedula`='$cedula' AND`numero`='$numero' AND`fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $candidato->setNombre($data[$i]['nombre']);
          $candidato->setCedula($data[$i]['cedula']);
          $candidato->setNumero($data[$i]['numero']);
          $candidato->setFecha($data[$i]['fecha']);

          }
      return $candidato;      
    } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function countnumero($candidato){
      $numero=$candidato->getNumero();
      $fecha=$candidato->getFecha();

      try {
          $sql= "SELECT count(numero) as cuenta "
          ."FROM candidato "
          ."WHERE fecha='$fecha' AND numero ='$numero'";
          $data = $this->ejecutarConsulta($sql);
          $cuenta = 0;
          for ($i=0; $i < count($data) ; $i++) {      
            $cuenta = $data[$i]['cuenta'];
          }
      return $cuenta;   

      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Candidato en la base de datos.
     * @param candidato objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($candidato){
      $nombre=$candidato->getNombre();
$cedula=$candidato->getCedula();
$numero=$candidato->getNumero();
$fecha=$candidato->getFecha();

      try {
          $sql= "UPDATE `candidato` SET`nombre`='$nombre' ,`cedula`='$cedula' ,`numero`='$numero' ,`fecha`='$fecha' WHERE `cedula`='$cedula' AND `numero`='$numero' AND `fecha`='$fecha' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($candidato){
      $cedula=$candidato->getCedula();
$numero=$candidato->getNumero();
$fecha=$candidato->getFecha();

      try {
          $sql ="DELETE FROM `candidato` WHERE `cedula`='$cedula' AND`numero`='$numero' AND`fecha`='$fecha'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Candidato en la base de datos.
     * @return ArrayList<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `nombre`, `cedula`, `numero`, `fecha`, numero_candidato "
          ."FROM `candidato` "
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $candidato= new Candidato();
              $candidato->setNombre($data[$i]['nombre']);
              $candidato->setCedula($data[$i]['cedula']);
              $candidato->setNumero($data[$i]['numero']);
              $candidato->setFecha($data[$i]['fecha']);
              $candidato->setnumerocandidato($data[$i]['numero_candidato']);
          array_push($lista,$candidato);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($candidato){
      $lista = array();
      $cedula=$candidato->getCedula();

      try {
          $sql ="SELECT `nombre`, `cedula`, `numero`, `fecha`"
          ."FROM `candidato`"
          ."WHERE `cedula`='$cedula'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $candidato = new Candidato();
          $candidato->setNombre($data[$i]['nombre']);
          $candidato->setCedula($data[$i]['cedula']);
          $candidato->setNumero($data[$i]['numero']);
          $candidato->setFecha($data[$i]['fecha']);

          array_push($lista,$candidato);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByNumero($candidato){
      $lista = array();
      $numero=$candidato->getNumero();

      try {
          $sql ="SELECT `nombre`, `cedula`, `numero`, `fecha`"
          ."FROM `candidato`"
          ."WHERE `numero`='$numero'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $candidato = new Candidato();
          $candidato->setNombre($data[$i]['nombre']);
          $candidato->setCedula($data[$i]['cedula']);
          $candidato->setNumero($data[$i]['numero']);
          $candidato->setFecha($data[$i]['fecha']);

          array_push($lista,$candidato);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($candidato){
      $lista = array();
      $fecha=$candidato->getFecha();

      try {
          $sql ="SELECT `nombre`, `cedula`, `numero`, `fecha`"
          ."FROM `candidato`"
          ."WHERE `fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $candidato = new Candidato();
          $candidato->setNombre($data[$i]['nombre']);
          $candidato->setCedula($data[$i]['cedula']);
          $candidato->setNumero($data[$i]['numero']);
          $candidato->setFecha($data[$i]['fecha']);

          array_push($lista,$candidato);
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