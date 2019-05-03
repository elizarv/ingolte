<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../../dao/interfaz/IAccionistasDao.php');
include_once realpath('../../dto/Accionistas.php');

class AccionistasDao implements IAccionistasDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Accionistas en la base de datos.
     * @param accionistas objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($accionistas){
      $cedula=$accionistas->getCedula();
      $nombre=$accionistas->getNombre();
      $acciones=$accionistas->getAcciones();

      try {
          $sql= "INSERT INTO `accionistas`( `cedula`, `nombre`, `acciones`)"
          ."VALUES ('$cedula','$nombre','$acciones')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($accionistas){
      $cedula=$accionistas->getCedula();

      try {
          $sql= "SELECT `cedula`, `nombre`, `acciones`"
          ."FROM `accionistas`"
          ."WHERE `cedula`='$cedula'";
          $data = $this->ejecutarConsulta($sql);
          $accionistas = new Accionistas();
          for ($i=0; $i < count($data) ; $i++) {
          $accionistas->setCedula($data[$i]['cedula']);
          $accionistas->setNombre($data[$i]['nombre']);
          $accionistas->setAcciones($data[$i]['acciones']);

          }
      return $accionistas;     
       } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function select2($accionistas){
      $cedula=$accionistas->getCedula();

      try {
          $sql= "SELECT `cedula`, `nombre`, `acciones`"
          ."FROM `accionistas`"
          ."WHERE `cedula`='$cedula'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $accionistas->setCedula($data[$i]['cedula']);
          $accionistas->setNombre($data[$i]['nombre']);
          $accionistas->setAcciones($data[$i]['acciones']);

          }
      return $accionistas;     
       } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($accionistas){
      $cedula=$accionistas->getCedula();
$nombre=$accionistas->getNombre();
$apellidos=$accionistas->getApellidos();
$acciones=$accionistas->getAcciones();

      try {
          $sql= "UPDATE `accionistas` SET`cedula`='$cedula' ,`nombre`='$nombre' ,`apellidos`='$apellidos' ,`acciones`='$acciones' WHERE `cedula`='$cedula' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($accionistas){
      $cedula=$accionistas->getCedula();

      try {
          $sql ="DELETE FROM `accionistas` WHERE `cedula`='$cedula'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Accionistas en la base de datos.
     * @return ArrayList<Accionistas> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $fecha = date("Y");
          $sql ="SELECT `cedula`, `nombre`, `acciones`"
          ."FROM accionistas "
          ."WHERE cedula NOT IN (SELECT cedula FROM periodo WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $accionistas= new Accionistas();
          $accionistas->setCedula($data[$i]['cedula']);
          $accionistas->setNombre($data[$i]['nombre']);
          $accionistas->setAcciones($data[$i]['acciones']);

          array_push($lista,$accionistas);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listAll2($cc){
      $lista = array();
      try {
        $fecha = date("Y");
          $sql ="SELECT `cedula`, `nombre`, `acciones`"
          ."FROM `accionistas`"
          ."WHERE `cedula` <> '$cc' AND cedula NOT IN (SELECT cedula FROM periodo WHERE fecha = '$fecha')"
          ."AND cedula NOT IN (SELECT representante_cc FROM periodo WHERE fecha = '$fecha') ";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $accionistas= new Accionistas();
          $accionistas->setCedula($data[$i]['cedula']);
          $accionistas->setNombre($data[$i]['nombre']);
          $accionistas->setAcciones($data[$i]['acciones']);

          array_push($lista,$accionistas);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listVotantes(){
    $lista = array();
      try {
          $fecha = date("Y");
          $sql ="SELECT `cedula`, `nombre`, `acciones`"
          ."FROM accionistas "
          ."WHERE cedula NOT IN (SELECT cedula FROM periodo WHERE fecha = '$fecha') "
          ."AND cedula NOT IN (SELECT cedula FROM registro_voto WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $accionistas= new Accionistas();
          $accionistas->setCedula($data[$i]['cedula']);
          $accionistas->setNombre($data[$i]['nombre']);
          $accionistas->setAcciones($data[$i]['acciones']);

          array_push($lista,$accionistas);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listAccionistasPoderInvalido($fecha){
    $lista = array();
      try {
          $sql ="SELECT `cedula`, `nombre`, `acciones`"
          ."FROM accionistas  WHERE cedula IN (SELECT cedula FROM periodo WHERE fecha ='$fecha' "
          ."AND valido = '1') AND cedula IN (SELECT cedula FROM registro_voto WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $accionistas= new Accionistas();
              $accionistas->setCedula($data[$i]['cedula']);
              $accionistas->setNombre($data[$i]['nombre']);
              $accionistas->setAcciones($data[$i]['acciones']);
              array_push($lista,$accionistas);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listAccionistasSinPoder($fecha){
    $lista = array();
      try {
          $sql ="SELECT cedula, nombre, acciones FROM accionistas WHERE cedula IN (SELECT cedula FROM registro_voto "
          ."WHERE fecha = '$fecha') AND cedula NOT IN (SELECT representante_cc FROM periodo WHERE fecha = '$fecha')
          AND cedula NOT IN (SELECT cedula FROM periodo WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $accionistas= new Accionistas();
              $accionistas->setCedula($data[$i]['cedula']);
              $accionistas->setNombre($data[$i]['nombre']);
              $accionistas->setAcciones($data[$i]['acciones']);
              array_push($lista,$accionistas);
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