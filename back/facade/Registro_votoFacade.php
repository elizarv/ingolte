<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿En serio? ¿Tantos buenos frameworks y estás usando Anarchy?  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Registro_voto.php');
require_once realpath('../../dao/interfaz/IRegistro_votoDao.php');

class Registro_votoFacade {

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
   * Crea un objeto Registro_voto a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param voto1
   */
  public static function insert( $cedula){
      $fecha = date("Y");
      $registro_voto = new Registro_voto();
      $registro_voto->setCedula($cedula); 
      $registro_voto->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $rtn = $registro_votoDao->insert($registro_voto);
     $registro_votoDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Registro_voto de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @return El objeto en base de datos o Null
   */
  public static function select($cedula, $fecha){
      $registro_voto = new Registro_voto();
      $registro_voto->setCedula($cedula); 
      $registro_voto->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $result = $registro_votoDao->select($registro_voto);
     $registro_votoDao->close();
     return $result;
  }

  public static function selectByFecha($fecha){
      $registro = new Registro_voto();
      $registro->setfecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registroDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $result = $registroDao->selectByFecha($registro);
     $registroDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Registro_voto  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   * @param voto1
   */
  public static function update($cedula, $fecha, $voto1){
      $registro_voto = self::select($cedula, $fecha);
      $registro_voto->setVoto1($voto1); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $registro_votoDao->update($registro_voto);
     $registro_votoDao->close();
  }

  /**
   * Elimina un objeto Registro_voto de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param fecha
   */
  public static function delete($cedula, $fecha){
      $registro_voto = new Registro_voto();
      $registro_voto->setCedula($cedula); 
      $registro_voto->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $registro_votoDao->delete($registro_voto);
     $registro_votoDao->close();
  }

  /**
   * Lista todos los objetos Registro_voto de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Registro_voto en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $result = $registro_votoDao->listAll();
     $registro_votoDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Registro_voto de la base de datos a partir de cedula.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByCedula($cedula){
      $registro_voto = new Registro_voto();
      $registro_voto->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $result = $registro_votoDao->listByCedula($registro_voto);
     $registro_votoDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Registro_voto de la base de datos a partir de fecha.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByFecha($fecha){
      $registro_voto = new Registro_voto();
      $registro_voto->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $registro_votoDao =$FactoryDao->getregistro_votoDao(self::getDataBaseDefault());
     $result = $registro_votoDao->listByFecha($registro_voto);
     $registro_votoDao->close();
     return $result;
  }


}
//That´s all folks!