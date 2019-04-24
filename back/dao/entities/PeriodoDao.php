<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.   \\

include_once realpath('../../dao/interfaz/IPeriodoDao.php');
include_once realpath('../../dto/Periodo.php');

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
          $sql= "INSERT INTO `periodo`(`fecha`,`cedula`, `representante_cc`)"
          ."VALUES ('$fecha','$cedula','$representante_cc')";
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

  /**
     * Cierra la conexión actual a la base de datos
     */
  public function close(){
      $cn=null;
  }
}