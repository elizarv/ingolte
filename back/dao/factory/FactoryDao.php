<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Los animales, asombrados, pasaron su mirada del cerdo al hombre, y del hombre al cerdo; y, nuevamente, del cerdo al hombre; pero ya era imposible distinguir quién era uno y quién era otro.  \\

include_once realpath('../../dao/conexion/Conexion.php');
include_once realpath('../../dao/interfaz/IFactoryDao.php');

class FactoryDao implements IFactoryDao{
	
     private $conn;
     public static $NULL_GESTOR = -1;
    public static $MYSQL_FACTORY = 0;
    public static $POSTGRESQL_FACTORY = 1;
    public static $ORACLE_FACTORY = 2;
    public static $DERBY_FACTORY = 3;

     public function __construct($gestor){
        $this->conn=new Conexion($gestor);
     }
     /**
     * Devuelve una instancia de AccionistasDao con una conexión que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de AccionistasDao
     */
     public function getAccionistasDao($dbName){
        return new AccionistasDao($this->conn->obtener($dbName));
    }
     /**
     * Devuelve una instancia de PeriodoDao con una conexión que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de PeriodoDao
     */
     public function getPeriodoDao($dbName){
        return new PeriodoDao($this->conn->obtener($dbName));
    }

    public function getCandidatoDao($dbName){
        return new CandidatoDao($this->conn->obtener($dbName));
    }

    public function getregistro_votoDao($dbName){
        return new Registro_votoDao($this->conn->obtener($dbName));
    }

}
//That´s all folks!