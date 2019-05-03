<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Por desgracia, mi epitafio será una frase insulsa y vacía  \\

require_once realpath('../../facade/GlobalController.php');
require_once realpath('../../dao/interfaz/IFactoryDao.php');
require_once realpath('../../dto/Candidato.php');
require_once realpath('../../dao/interfaz/ICandidatoDao.php');

class CandidatoFacade {

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
   * Crea un objeto Candidato a partir de sus parámetros y lo guarda en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param nombre
   * @param cedula
   * @param numero
   * @param fecha
   */
  public static function insert($fecha, $nombre, $cedula, $numero, $cuenta){
      $fecha = date("Y");
      $candidato = new Candidato();
      $candidato->setNombre($nombre); 
      $candidato->setCedula($cedula); 
      $candidato->setNumero($numero); 
      $candidato->setFecha($fecha); 
      $candidato->setcandidatonumero($cuenta);

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $rtn = $candidatoDao->insert($candidato);
     $candidatoDao->close();
     return $rtn;
  }

  public static function countnumero($fecha, $numero){
    $candidato = new Candidato();
    $candidato->setFecha($fecha);
    $candidato->setNumero($numero);

    $FactoryDao=new FactoryDao(self::getGestorDefault());
    $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
    $result = $candidatoDao->countnumero($candidato);
    $candidatoDao->close();
    return $result;
  }

  /**
   * Selecciona un objeto Candidato de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param numero
   * @param fecha
   * @return El objeto en base de datos o Null
   */
  public static function select($cedula, $numero, $fecha){
      $candidato = new Candidato();
      $candidato->setCedula($cedula); 
      $candidato->setNumero($numero); 
      $candidato->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $result = $candidatoDao->select($candidato);
     $candidatoDao->close();
     return $result;
  }

  /**
   * Modifica los atributos de un objeto Candidato  ya existente en base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param nombre
   * @param cedula
   * @param numero
   * @param fecha
   */
  public static function update($nombre, $cedula, $numero, $fecha){
      $candidato = self::select($cedula, $numero, $fecha);
      $candidato->setNombre($nombre); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $candidatoDao->update($candidato);
     $candidatoDao->close();
  }

  /**
   * Elimina un objeto Candidato de la base de datos a partir de su(s) llave(s) primaria(s).
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @param numero
   * @param fecha
   */
  public static function delete($cedula, $numero, $fecha){
      $candidato = new Candidato();
      $candidato->setCedula($cedula); 
      $candidato->setNumero($numero); 
      $candidato->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $candidatoDao->delete($candidato);
     $candidatoDao->close();
  }

  /**
   * Lista todos los objetos Candidato de la base de datos.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @return $result Array con los objetos Candidato en base de datos o Null
   */
  public static function listAll(){
     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $result = $candidatoDao->listAll();
     $candidatoDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Candidato de la base de datos a partir de cedula.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param cedula
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByCedula($cedula){
      $candidato = new Candidato();
      $candidato->setCedula($cedula); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $result = $candidatoDao->listByCedula($candidato);
     $candidatoDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Candidato de la base de datos a partir de numero.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param numero
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByNumero($numero){
      $candidato = new Candidato();
      $candidato->setNumero($numero); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $result = $candidatoDao->listByNumero($candidato);
     $candidatoDao->close();
     return $result;
  }

  /**
   * Lista todos los objetos Candidato de la base de datos a partir de fecha.
   * Puede recibir NullPointerException desde los métodos del Dao
   * @param fecha
   * @return $result Array con los objetos en base de datos o Null
   */
  public static function listByFecha($fecha){
      $candidato = new Candidato();
      $candidato->setFecha($fecha); 

     $FactoryDao=new FactoryDao(self::getGestorDefault());
     $candidatoDao =$FactoryDao->getcandidatoDao(self::getDataBaseDefault());
     $result = $candidatoDao->listByFecha($candidato);
     $candidatoDao->close();
     return $result;
  }


}
//That´s all folks!