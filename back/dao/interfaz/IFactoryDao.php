<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¿Documentaqué?  \\

include_once realpath('../../dao/entities/AccionistasDao.php');
include_once realpath('../../dao/entities/PeriodoDao.php');
include_once realpath('../../dao/entities/CandidatoDao.php');
include_once realpath('../../dao/entities/Registro_votoDao.php');


interface IFactoryDao {
	
     /**
     * Devuelve una instancia de AccionistasDao con una conexión que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de AccionistasDao
     */
     public function getAccionistasDao($dbName);
     /**
     * Devuelve una instancia de PeriodoDao con una conexión que depende del gestor de base de datos
     * @param dbName Nombre o identificador de la base de datos a conectar
     * @return instancia de PeriodoDao
     */
     public function getPeriodoDao($dbName);

     public function getCandidatoDao($dbName);

}
//That´s all folks!
