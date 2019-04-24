<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Ella no te quiere </3 mejor ponte a programar  \\

interface IConexion {

    /**     
     * Crea una conexión si no se ha establecido antes; en caso contrario, devuelve la ya existente
     * @param dbName Nombre de la base de datos que se desea conectar.
     * @return Conexión a base de datos dependiente del gestor en uso
     */
     public function obtener($dbName);
     /**
     * Cierra la conexión a la base de datos
     */
     public function cerrar();

}
//That´s all folks!