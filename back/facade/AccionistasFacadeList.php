<?php

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Accionistas.php');
require_once realpath('../../dao/interfaz/IAccionistasDao.php');

class AccionistasFacadeList {

    private static $FactoryDao;

    function __construct() {
    }
 
    public function getFactoryDao() {
       if (self::$FactoryDao == null){
          self::$FactoryDao = new FactoryDao(self::getGestorDefault());
       }
       return self::$FactoryDao;
    }
 
   /**
    * Para su comodidad, defina aquí el gestor de conexión predilecto para esta entidad
    * @return idGestor Devuelve el identificador del gestor de conexión
    */
   private function getGestorDefault(){
       return DEFAULT_GESTOR;
   }
   /**
    * Para su comodidad, defina aquí el nombre de base de datos predilecto para esta entidad
    * @return dbName Devuelve el nombre de la base de datos a emplear
    */
   private function getDataBaseDefault(){
       return DEFAULT_DBNAME;
   }

   public function listAll(){
    $FactoryDao= self::getFactoryDao();
    $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
    $result = $accionistasDao->listAll();
    // $accionistasDao->close();
    return $result;
 }



}

?>