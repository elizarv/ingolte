<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Cansado de escribir bugs? tranquilo, los escribimos por ti  \\
    require_once realpath('../../dao/factory/FactoryDao.php');

/**
   * Para su comodidad, defina aquí el gestor de conexión predilecto para su proyecto
   */
    define("DEFAULT_GESTOR", FactoryDao::$MYSQL_FACTORY);
  /**
   * Para su comodidad, defina aquí el nombre de base de datos predilecto para su proyecto
   */    
    define("DEFAULT_DBNAME", "votacion_accionistas");

//That´s all folks!