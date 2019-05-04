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
  public static function update($cedula, $nombre, $apellidos, $acciones){
      $accionistas = self::select($cedula);
      $accionistas->setNombre($nombre); 
      $accionistas->setApellidos($apellidos); 
      $accionistas->setAcciones($acciones); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $accionistasDao->update($accionistas);
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
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $accionistasDao =$FactoryDao->getaccionistasDao(self::getDataBaseDefault());
     $result = $accionistasDao->listAll();
     $accionistasDao->close();
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