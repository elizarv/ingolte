<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Caminante no hay camino, se hace camino al andar  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Periodo.php');
require_once realpath('../../dao/interfaz/IPeriodoDao.php');

class PeriodoFacade {

  /**
   * Para su comodidad, defina aquí el gestor de conexión predilecto para esta entidad
   * @return idGestor Devuelve el identificador del gestor de conexión
   */
  private static function getGestorDefault(){
      return DEFAULT_GESTOR;
  }
  /**
   * Para su comodidad, defina aquí el nombre de base de datos predilecto para esta entidad
   * @return dbName Devuelve el nombre de la base de datos a emplear
   */
  private static function getDataBaseDefault(){
      return DEFAULT_DBNAME;
  }
  /**
   * Crea un objeto Accionistas a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param nombre
   * @param apellidos
   * @param acciones
   */
  public static function insert($accionistas,  $representante_cc, $num){
      $periodo = new Periodo();
      $periodo->setCedula($accionistas->getCedula());
      $periodo->setRepresentante_cc($representante_cc); 
      $periodo->setnumradicado($num);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $PeriodoDao =$FactoryDao->getPeriodoDao(self::getDataBaseDefault());
     $rtn = $PeriodoDao->insert($periodo);
     $PeriodoDao->close();
     return $rtn;
  }


  public static function select($cedula, $fecha){
      $periodo = new Periodo();
      $periodo->setCedula($cedula); 
      $periodo->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $result = $periodoDao->select($periodo);
     $periodoDao->close();
     return $result;
  }

  public static function update($cedula, $fecha, $valido){
      $periodo = self::select($cedula, $fecha);
      $periodo->setvalido($valido);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $periodoDao->update($periodo);
     $periodoDao->close();
  }

   public static function selectByFecha($fecha){
      $periodo = new Periodo();
      $periodo->setfecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getPeriodoDao(self::getDataBaseDefault());
     $result = $periodoDao->selectByFecha($periodo);
     $periodoDao->close();
     return $result;
  }

  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $result = $periodoDao->listAll();
     $periodoDao->close();
     return $result;
  }

  public static function listPoderes($fecha){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $result = $periodoDao->listPoderes($fecha);
     $periodoDao->close();
     return $result;
  }

  public static function listPoderesAsistencia($fecha){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $result = $periodoDao->listPoderesAsistencia($fecha);
     $periodoDao->close();
     return $result; 
  }

  public static function deleteconsecutivo($numero){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $periodoDao =$FactoryDao->getperiodoDao(self::getDataBaseDefault());
     $result = $periodoDao->deleteconsecutivo($numero);
     $periodoDao->close();
     return $result; 
  }


}