<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Me ayudas con la tesis?  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Otras_votaciones.php');
require_once realpath('../../dao/interfaz/IOtras_votacionesDao.php');

class Otras_votacionesFacade {

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


  public static function insert( $nombre,  $fecha){
      $otras_votaciones = new Otras_votaciones();
      $otras_votaciones->setFecha($fecha); 
      $otras_votaciones->setnombre($nombre);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otras_votacionesDao =$FactoryDao->getotras_votacionesDao(self::getDataBaseDefault());
     $rtn = $otras_votacionesDao->insert($otras_votaciones);
     $otras_votacionesDao->close();
     return $rtn;
  }
  
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otrasDao =$FactoryDao->getOtras_votacionesDao(self::getDataBaseDefault());
     $result = $otrasDao->listAll();
     $otrasDao->close();
     return $result;
  }


}
//That´s all folks!