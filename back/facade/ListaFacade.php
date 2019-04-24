<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¡Alza el puño y ven! ¡En la hoguera hay de beber!  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Lista.php');
require_once realpath('../../dao/interfaz/IListaDao.php');

class ListaFacade {

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
   * Crea un objeto Lista a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @param numero
   */
  public static function insert( $fecha,  $numero){
      $lista = new Lista();
      $lista->setFecha($fecha); 
      $lista->setNumero($numero); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $rtn = $listaDao->insert($lista);
     $listaDao->close();
     return $rtn;
  }

  /**
   * Selecciona un objeto Lista de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @param numero
   * @return El objeto en base de datos o Null
   */
  public static function select($fecha, $numero){
      $lista = new Lista();
      $lista->setFecha($fecha); 
      $lista->setNumero($numero); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $result = $listaDao->select($lista);
     $listaDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Lista  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @param numero
   */
  public static function update($fecha, $numero){
      $lista = self::select($fecha, $numero);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $listaDao->update($lista);
     $listaDao->close();
  }

  /**
   * Elimina un objeto Lista de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @param numero
   */
  public static function delete($fecha, $numero){
      $lista = new Lista();
      $lista->setFecha($fecha); 
      $lista->setNumero($numero); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $listaDao->delete($lista);
     $listaDao->close();
  }

  /**
   * Lista todos los objetos Lista de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Lista en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $result = $listaDao->listAll();
     $listaDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Lista de la base de datos a partir de fecha.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByFecha($fecha){
      $lista = new Lista();
      $lista->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $result = $listaDao->listByFecha($lista);
     $listaDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Lista de la base de datos a partir de numero.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param numero
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByNumero($numero){
      $lista = new Lista();
      $lista->setNumero($numero); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $listaDao =$FactoryDao->getlistaDao(self::getDataBaseDefault());
     $result = $listaDao->listByNumero($lista);
     $listaDao->close();
     return $result;
  }


}
//That´s all folks!