<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Caminante no hay camino, se hace camino al andar  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Accionistas.php');
require_once realpath('../../dao/interfaz/IAccionistasDao.php');

class AccionistasFacade {

   private static $FactoryDao;

   public static function getFactoryDao() {
      if (self::$FactoryDao == null){
         self::$FactoryDao = new FactoryDao(self::getGestorDefault());
      }
      return self::$FactoryDao;
   }

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
  public static function insert( $cedula,  $nombre){
      $accionistas = new Accionistas();
      $accionistas->setCedula($cedula); 
      $accionistas->setNombre($nombre); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $rtn = $accionistasDao->insert($accionistas);
     $accionistasDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Accionistas de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @return El objeto en base de datos o Null
   */
  public static function select($cedula){
      $accionistas = new Accionistas();
      $accionistas->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->select($accionistas);
     $accionistasDao->close();
     return $result;
  }

  public static function select2($cedula){
      $accionistas = new Accionistas();
      $accionistas->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->select2($accionistas);
     $accionistasDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Accionistas  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param nombre
   * @param apellidos
   * @param acciones
   */
  public static function update($cedula, $nombre, $acciones, $cc){
      $accionistas = self::select($cedula);
      $accionistas->setCedula($cedula);
      $accionistas->setNombre($nombre); 
      $accionistas->setAcciones($acciones); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $accionistasDao->update($accionistas, $cc);
     $accionistasDao->close();
  }

  /**
   * Elimina un objeto Accionistas de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   */
  public static function delete($cedula){
      $accionistas = new Accionistas();
      $accionistas->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $accionistasDao->delete($accionistas);
     $accionistasDao->close();
  }

  /**
   * Lista todos los objetos Accionistas de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Accionistas en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao= self::getFactoryDao();
   //   $accionistas_json = file_get_contents(realpath("../../../db/db.json"));
   //   $decoded_json = json_decode($accionistas_json, true);
   //   if ($decoded_json != null) return $decoded_json;
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listAll();
   //   $json = json_encode(array($result));
   //   file_put_contents("../../../db/db.json", $json);
   //   $accionistasDao->close();
     return $result;
  }

  public static function listAll2($cc){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listAll2($cc);
     $accionistasDao->close();
     return $result;
  }

  public static function listVotantes(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listVotantes();
     $accionistasDao->close();
     return $result;
  }

  public static function listAccionistasPoderInvalido($fecha){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listAccionistasPoderInvalido($fecha);
     $accionistasDao->close();
     return $result; 
  }

  public static function listAccionistasSinPoder($fecha){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listAccionistasSinPoder($fecha);
     $accionistasDao->close();
     return $result; 
  }


}
//That´s all folks!