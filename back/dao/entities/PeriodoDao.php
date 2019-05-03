<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../../dao/interfaz/IPeriodoDao.php');
include_once realpath('../../dto/Periodo.php');
include_once realpath('../../dto/Poder.php');
include_once realpath('../../dto/Accionistas.php');

class PeriodoDao implements IPeriodoDao{

private $cn;

    /**
     * Inicializa una única conexión a la base de datos, que se usará para cada consulta.
     */
    function __construct($conexion) {
            $this->cn =$conexion;
    }

    /**
     * Guarda un objeto Periodo en la base de datos.
     * @param periodo objeto a guardar
     * @return  Valor asignado a la llave primaria 
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($periodo){
      $cedula=$periodo->getCedula();
      $representante_cc=$periodo->getRepresentante_cc();
      $num_radicado = $periodo->getnumradicado();
      $fecha=date("Y");
      try {
          $sql = "SELECT SUM(a.acciones) as suma FROM accionistas a, periodo p".
          " WHERE a.cedula = p.cedula AND p.representante_cc = '$representante_cc'".
          " AND p.fecha = '$fecha'";
          $rta1 = $this->ejecutarConsulta($sql);
          $sql = "SELECT acciones FROM accionistas WHERE cedula = '$cedula'";
          $rta2 = $this->ejecutarConsulta($sql);
          if($rta1[0]['suma'] + $rta2[0]['acciones'] > 250){
            return "Error";
          }
          $sql = "SELECT cedula, num_radicado FROM periodo WHERE cedula = '$cedula' AND fecha = '$fecha'";
          $rta3 = $this->ejecutarConsulta($sql);
          if(sizeof($rta3)!=0){
            if($rta3[0]['num_radicado']<$num_radicado)$sql = "UPDATE periodo SET representante_cc = '$representante_cc', num_radicado = '$num_radicado' WHERE cedula = '$cedula' AND fecha = '$fecha'";
            $this->insertarConsulta($sql);
            return "Update";
          }else{
            $sql= "INSERT INTO `periodo`(`fecha`,`cedula`, `representante_cc`, num_radicado)"
            ."VALUES ('$fecha','$cedula','$representante_cc','$num_radicado')";            
          }
          return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }



public function update($periodo){
      $cedula=$periodo->getCedula();
      $fecha=$periodo->getFecha();
      $valido=$periodo->getvalido();
      try {
          $sql= "UPDATE periodo SET `valido`='$valido' WHERE `cedula`='$cedula' AND `fecha`='$fecha' ;";
         return $this->insertarConsulta($sql);
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      }
  }


  public function select($periodo){
      $cedula=$periodo->getCedula();
$fecha=$periodo->getFecha();

      try {
          $sql= "SELECT `cedula`, `fecha`"
          ."FROM `periodo`"
          ."WHERE `cedula`='$cedula' AND`fecha`='$fecha'";
          $data = $this->ejecutarConsulta($sql);
          $periodo = new Periodo();
          for ($i=0; $i < count($data) ; $i++) {
          $periodo->setCedula($data[$i]['cedula']);
          $periodo->setFecha($data[$i]['fecha']);

          }
      return $periodo;   
         } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }

 public function selectByFecha($periodo){
      $fecha=$periodo->getfecha();

      try {
          $sql= "SELECT cedula FROM periodo WHERE fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
          $periodo->setCedula($data[$i]['cedula']);
          }
      return $periodo;     
       } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
  }


    public function listAll(){
      $lista = array();
      try {
          $fecha = date("Y");
          $sql ="SELECT a.nombre, a.cedula as c1, p.num_radicado, p.representante_cc as c2, (select a2.nombre from accionistas a2, periodo p2 where a2.cedula = p2.representante_cc and p2.cedula = c1)as n2 from accionistas a, periodo p where a.cedula = p.cedula AND fecha = '$fecha'";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $periodo= new Periodo();
          $periodo->setCedula($data[$i]['c1']);
          $periodo->setNombre($data[$i]['n2']);
          $periodo->setCedula2($data[$i]['c2']);
          $periodo->setNombre2($data[$i]['nombre']);
          $periodo->setnumradicado($data[$i]['num_radicado']);
          array_push($lista,$periodo);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
    }


    public function listPoderes($fecha){
      $lista = array();
      try {
          $sql ="SELECT nombre, cedula, acciones FROM accionistas WHERE cedula IN (SELECT representante_cc FROM periodo WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $poder= new Poder();
              $repre = $data[$i]['cedula'];
              $poder->setCedula($data[$i]['cedula']);
              $poder->setNombre($data[$i]['nombre']);
              $poder->setacciones($data[$i]['acciones']);
              $sql2 = "SELECT a.nombre, a.cedula, a.acciones FROM accionistas a, periodo p WHERE p.cedula = a.cedula AND p.representante_cc = '$repre' AND p.fecha = '$fecha'";
              $data2 = $this->ejecutarConsulta($sql2);
              $lista2 = array();
              for($j=0; $j < count($data2); $j++){
                  $poderdante = new Accionistas();
                  $poderdante->setCedula($data2[$j]['cedula']);
                  $poderdante->setNombre($data2[$j]['nombre']);
                  $poderdante->setacciones($data2[$j]['acciones']);
                  array_push($lista2,$poderdante);
              }
              $poder->setpoderdantes($lista2);
              array_push($lista,$poder);
          }
      return $lista;
      } catch (SQLException $e) {
          throw new Exception('Primary key is null');
      return null;
      }
    }

    public function listPoderesAsistencia($fecha){
      $lista = array();
      try {
          $sql ="SELECT nombre, cedula, acciones FROM accionistas WHERE cedula IN (SELECT representante_cc FROM periodo WHERE fecha = '$fecha') AND "
          ."cedula IN (SELECT cedula FROM registro_voto WHERE fecha = '$fecha')";
          $data = $this->ejecutarConsulta($sql);
          for ($i=0; $i < count($data) ; $i++) {
              $poder= new Poder();
              $repre = $data[$i]['cedula'];
              $poder->setCedula($data[$i]['cedula']);
              $poder->setNombre($data[$i]['nombre']);
              $poder->setacciones($data[$i]['acciones']);
              $sql2 = "SELECT a.nombre, a.cedula, a.acciones FROM accionistas a, periodo p WHERE p.cedula = a.cedula AND p.representante_cc = '$repre' AND p.fecha = '$fecha' AND p.valido = '0'";
              $data2 = $this->ejecutarConsulta($sql2);
              $lista2 = array();
              for($j=0; $j < count($data2); $j++){
                  $poderdante = new Accionistas();
                  $poderdante->setCedula($data2[$j]['cedula']);
                  $poderdante->setNombre($data2[$j]['nombre']);
                  $poderdante->setacciones($data2[$j]['acciones']);
                  array_push($lista2,$poderdante);
              }
              $poder->setpoderdantes($lista2);
              array_push($lista,$poder);
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