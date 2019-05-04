<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Vva 'l doro  \\

include_once realpath('../../dao/interfaz/IRegistro_votoDao.php');
include_once realpath('../../dto/Registro_voto.php');
include_once realpath('../../dto/Resultados.php');

class Registro_votoDao implements IRegistro_votoDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($registro_voto){
      $cedula=$registro_voto->getCedula();
      $fecha =$registro_voto->getfecha();
      try {
          $sql ="SELECT `cedula`"
          ."FROM accionistas "
          ."WHERE cedula IN (SELECT cedula FROM periodo WHERE fecha = '$fecha' AND representante_cc = '$cedula')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
            $cc = $data[$i]['cedula'];
            $sql= "INSERT INTO `registro_voto`( `cedula`, `fecha`)"
            ."VALUES ('$cc','$fecha')";
            $this->insertarConsulta($sql);
          }
          $sql= "INSERT INTO `registro_voto`( `cedula`, `fecha`)"
          ."VALUES ('$cedula','$fecha')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($registro_voto){
      $cedula=$registro_voto->getCedula();
$fecha=$registro_voto->getFecha();

      try {
          $sql= "SELECT `cedula`, `fecha`, `voto1`"
          ."FROM `registro_voto`"
          ."WHERE `cedula`='$cedula' AND`fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          $registro_voto = new Registro_voto();
          for ($i=0; $i < count($data) ; $i++) {
          $registro_voto->setCedula($data[$i]['cedula']);
          $registro_voto->setFecha($data[$i]['fecha']);
          $registro_voto->setVoto1($data[$i]['voto1']);

          }
      return $registro_voto;   
         } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }


  public function countacciones($fecha){

      try {
          $sql= "SELECT sum(acciones) as total "
          ."FROM `accionistas` "
          ."WHERE `cedula` IN (SELECT cedula FROM registro_voto WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          $resultado = new Resultados();
          for ($i=0; $i < count($data) ; $i++) {
            $resultado->setvotos($data[$i]['total']);

          }
      return $resultado;   
         } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function selectByFecha($registro){
      $fecha=$registro->getfecha();

      try {
          $sql= "SELECT cedula FROM registro_voto WHERE fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $registro->setCedula($data[$i]['cedula']);
          }
      return $registro;     
       } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($registro_voto){
      $cedula=$registro_voto->getCedula();
      $fecha=$registro_voto->getFecha();
      $voto1=$registro_voto->getVoto1();

      try {
          $sql= "UPDATE `registro_voto` SET `fecha_lista`='$fecha' ,`voto1`='$voto1' WHERE `cedula`='$cedula' AND `fecha`='$fecha' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($registro_voto){
      $cedula=$registro_voto->getCedula();
$fecha=$registro_voto->getFecha();

      try {
          $sql ="DELETE FROM `registro_voto` WHERE `cedula`='$cedula' AND`fecha`='$fecha'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Registro_voto en la base de datos.
     * @return ArrayList<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `cedula`, `fecha`, `voto1`"
          ."FROM `registro_voto`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $registro_voto= new Registro_voto();
          $registro_voto->setCedula($data[$i]['cedula']);
          $registro_voto->setFecha($data[$i]['fecha']);
          $registro_voto->setVoto1($data[$i]['voto1']);

          array_push($lista,$registro_voto);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

  public function listResultados($fecha){
      $lista = array();
      try {
          $sql ="SELECT `numero` "
          ."FROM `lista` "
          ."WHERE fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
            $numero = $data[$i]['numero'];
            $resultado= new Resultados();
            
            $sql2 = "SELECT sum(acciones) as cantidad FROM accionistas "
            ."WHERE cedula IN (SELECT cedula FROM registro_voto WHERE voto1 = '$numero')";
            $data2 = $this->ejecutarConsulta($sql2);
            $total = $data2[0]['cantidad'];

            $resultado->setlista($numero);
            $resultado->setvotos($total);
            array_push($lista,$resultado);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($registro_voto){
      $lista = array();
      $cedula=$registro_voto->getCedula();

      try {
          $sql ="SELECT `cedula`, `fecha`, `voto1`"
          ."FROM `registro_voto`"
          ."WHERE `cedula`='$cedula'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $registro_voto = new Registro_voto();
          $registro_voto->setCedula($data[$i]['cedula']);
          $registro_voto->setFecha($data[$i]['fecha']);
          $registro_voto->setVoto1($data[$i]['voto1']);

          array_push($lista,$registro_voto);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($registro_voto){
      $lista = array();
      $fecha=$registro_voto->getFecha();

      try {
          $sql ="SELECT `cedula`, `fecha`, `voto1`"
          ."FROM `registro_voto`"
          ."WHERE `fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $registro_voto = new Registro_voto();
          $registro_voto->setCedula($data[$i]['cedula']);
          $registro_voto->setFecha($data[$i]['fecha']);
          $registro_voto->setVoto1($data[$i]['voto1']);

          array_push($lista,$registro_voto);
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