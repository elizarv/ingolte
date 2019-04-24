<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    They call me Mr. Espagueti  \\


interface IPeriodoDao {

    /**
     * Guarda un objeto Periodo en la base de datos.
     * @param periodo objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($periodo);
    /**
     * Modifica un objeto Periodo en la base de datos.
     * @param periodo objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
    /*
  public function update($periodo);
    /**
     * Elimina un objeto Periodo en la base de datos.
     * @param periodo objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
    /*
  public function delete($periodo);
    /**
     * Busca un objeto Periodo en la base de datos.
     * @param periodo objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
/*
  public function select($periodo);
    /**
     * Lista todos los objetos Periodo en la base de datos.
     * @return Array<Periodo> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
    /*
  public function listAll();
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!