<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Me ayudas con la tesis?  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Otros_votos.php');
require_once realpath('../../dao/interfaz/IOtros_votosDao.php');

class Otros_votosFacade {

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
   * Crea un objeto Otros_votos a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param id
   * @param voto
   */
  public static function insert( $cedula,  $fecha,  $id,  $voto){
      $otros_votos = new Otros_votos();
      $otros_votos->setCedula($cedula); 
      $otros_votos->setFecha($fecha); 
      $otros_votos->setId($id); 
      $otros_votos->setVoto($voto); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $rtn = $otros_votosDao->insert($otros_votos);
     $otros_votosDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Otros_votos de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param id
   * @return El objeto en base de datos o Null
   */
  public static function select($cedula, $fecha, $numero){
      $otros_votos = new Otros_votos();
      $otros_votos->setCedula($cedula); 
      $otros_votos->setFecha($fecha); 
      $otros_votos->setid($numero);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->select($otros_votos);
     $otros_votosDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Otros_votos  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param id
   * @param voto
   */
  public static function update($cedula, $fecha, $id, $voto){
      $otros_votos = self::select($cedula, $fecha, $id);
      $otros_votos->setVoto($voto); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $otros_votosDao->update($otros_votos);
     $otros_votosDao->close();
  }

  /**
   * Elimina un objeto Otros_votos de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param id
   */
  public static function delete($cedula, $fecha, $id){
      $otros_votos = new Otros_votos();
      $otros_votos->setCedula($cedula); 
      $otros_votos->setFecha($fecha); 
      $otros_votos->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $otros_votosDao->delete($otros_votos);
     $otros_votosDao->close();
  }

  /**
   * Lista todos los objetos Otros_votos de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Otros_votos en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->listAll();
     $otros_votosDao->close();
     return $result;
  }

  public static function listResultados($fecha){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->listResultados($fecha);
     $otros_votosDao->close();
     return $result;
  }

  

  /**
   * Lista todos los objetos Otros_votos de la base de datos a partir de cedula.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByCedula($cedula){
      $otros_votos = new Otros_votos();
      $otros_votos->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->listByCedula($otros_votos);
     $otros_votosDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Otros_votos de la base de datos a partir de fecha.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByFecha($fecha){
      $otros_votos = new Otros_votos();
      $otros_votos->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->listByFecha($otros_votos);
     $otros_votosDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Otros_votos de la base de datos a partir de id.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param id
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listById($id){
      $otros_votos = new Otros_votos();
      $otros_votos->setId($id); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $otros_votosDao =$FactoryDao->getotros_votosDao(self::getDataBaseDefault());
     $result = $otros_votosDao->listById($otros_votos);
     $otros_votosDao->close();
     return $result;
  }


}
//That´s all folks!