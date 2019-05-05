<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../../dao/interfaz/IOtros_votosDao.php');
include_once realpath('../../dto/Otros_votos.php');

class Otros_votosDao implements IOtros_votosDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($otros_votos){
      $cedula=$otros_votos->getCedula();
      $fecha=$otros_votos->getFecha();
      $id=$otros_votos->getId();
      $voto=$otros_votos->getVoto();

      try {
        $sql = "SELECT cedula FROM accionistas WHERE cedula IN (SELECT cedula FROM periodo WHERE fecha = '$fecha' "
                ."AND representante_cc = '$cedula' AND valido = '0')";
          $data = $this->ejecutarConsulta($sql);
          for($i=0; $i < count($data); $i++){
            $cc = $data[$i]['cedula'];
            $sql2 = "INSERT INTO `otros_votos`( `cedula`, `fecha`, `id`, `voto`)"
          ."VALUES ('$cc','$fecha','$id','$voto')";
            $this->insertarConsulta($sql2);
          }        
          $sql= "INSERT INTO `otros_votos`( `cedula`, `fecha`, `id`, `voto`)"
          ."VALUES ('$cedula','$fecha','$id','$voto')";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($otros_votos){
      $cedula=$otros_votos->getCedula();
      $fecha=$otros_votos->getFecha();
      $id = $otros_votos->getid();

      try {
          $sql= "SELECT `cedula`, `fecha`, `id`, `voto`"
          ."FROM `otros_votos`"
          ."WHERE `cedula`='$cedula' AND`fecha`='$fecha' AND id = '$id'";
          $otros_votos = new Otros_votos();
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
            $otros_votos->setCedula($data[$i]['cedula']);
            $otros_votos->setFecha($data[$i]['fecha']);
            $otros_votos->setId($data[$i]['id']);
            $otros_votos->setVoto($data[$i]['voto']);
          }
      return $otros_votos;      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Modifica un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la información a modificar
     * @return  Valor de la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($otros_votos){
      $cedula=$otros_votos->getCedula();
$fecha=$otros_votos->getFecha();
$id=$otros_votos->getId();
$voto=$otros_votos->getVoto();

      try {
          $sql= "UPDATE `otros_votos` SET`cedula`='$cedula' ,`fecha`='$fecha' ,`id`='$id' ,`voto`='$voto' WHERE `cedula`='$cedula' AND `fecha`='$fecha' AND `id`='$id' ";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Elimina un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return  Valor de la llave primaria eliminada
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($otros_votos){
      $cedula=$otros_votos->getCedula();
$fecha=$otros_votos->getFecha();
$id=$otros_votos->getId();

      try {
          $sql ="DELETE FROM `otros_votos` WHERE `cedula`='$cedula' AND`fecha`='$fecha' AND`id`='$id'";
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }

    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @return ArrayList<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll(){
      $lista = array();
      try {
          $sql ="SELECT `cedula`, `fecha`, `id`, `voto`"
          ."FROM `otros_votos`"
          ."WHERE 1";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $otros_votos= new Otros_votos();
          $otros_votos->setCedula($data[$i]['cedula']);
          $otros_votos->setFecha($data[$i]['fecha']);
          $otros_votos->setId($data[$i]['id']);
          $otros_votos->setVoto($data[$i]['voto']);

          array_push($lista,$otros_votos);
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
          $sql ="SELECT id, nombre "
          ."FROM `otras_votaciones`"
          ."WHERE fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $Resultado = new Resultados();
              $nombre = $data[$i]['nombre'];
              $id = $data[$i]['id'];
              $Resultado->setnombre($nombre);

              $sql2 = "SELECT sum(acciones) as si "
              ."FROM accionistas WHERE cedula IN (SELECT cedula "
              ."FROM otros_votos WHERE fecha = '$fecha' "
              ."AND id = '$id' AND voto ='1')";
              $data2 = $this->ejecutarConsulta($sql2);
              if($data2[0]['si']=='')$Resultado->setvotos('0');
              else $Resultado->setvotos($data2[0]['si']);

              $sql2 = "SELECT sum(acciones) as no "
              ."FROM accionistas WHERE cedula IN (SELECT cedula "
              ."FROM otros_votos WHERE fecha = '$fecha' "
              ."AND id = '$id' AND voto ='2')";
              $data2 = $this->ejecutarConsulta($sql2);
              if($data2[0]['no']=='')$Resultado->setvotosno('0');
              else $Resultado->setvotosno($data2[0]['no']);

              $sql2 = "SELECT sum(acciones) as blanco "
              ."FROM accionistas WHERE cedula IN (SELECT cedula "
              ."FROM otros_votos WHERE fecha = '$fecha' "
              ."AND id = '$id' AND voto ='0')";
              $data2 = $this->ejecutarConsulta($sql2);
              
              if($data2[0]['blanco']=='')$Resultado->setblancos('0');
              else $Resultado->setblancos($data2[0]['blanco']);
              array_push($lista,$Resultado);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($otros_votos){
      $lista = array();
      $cedula=$otros_votos->getCedula();

      try {
          $sql ="SELECT `cedula`, `fecha`, `id`, `voto`"
          ."FROM `otros_votos`"
          ."WHERE `cedula`='$cedula'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $otros_votos = new Otros_votos();
          $otros_votos->setCedula($data[$i]['cedula']);
          $otros_votos->setFecha($data[$i]['fecha']);
          $otros_votos->setId($data[$i]['id']);
          $otros_votos->setVoto($data[$i]['voto']);

          array_push($lista,$otros_votos);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($otros_votos){
      $lista = array();
      $fecha=$otros_votos->getFecha();

      try {
          $sql ="SELECT `cedula`, `fecha`, `id`, `voto`"
          ."FROM `otros_votos`"
          ."WHERE `fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $otros_votos = new Otros_votos();
          $otros_votos->setCedula($data[$i]['cedula']);
          $otros_votos->setFecha($data[$i]['fecha']);
          $otros_votos->setId($data[$i]['id']);
          $otros_votos->setVoto($data[$i]['voto']);

          array_push($lista,$otros_votos);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return ArrayList<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listById($otros_votos){
      $lista = array();
      $id=$otros_votos->getId();

      try {
          $sql ="SELECT `cedula`, `fecha`, `id`, `voto`"
          ."FROM `otros_votos`"
          ."WHERE `id`='$id'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $otros_votos = new Otros_votos();
          $otros_votos->setCedula($data[$i]['cedula']);
          $otros_votos->setFecha($data[$i]['fecha']);
          $otros_votos->setId($data[$i]['id']);
          $otros_votos->setVoto($data[$i]['voto']);

          array_push($lista,$otros_votos);
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