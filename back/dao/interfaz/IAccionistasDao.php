<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Tienes que considerar la posibilidad de que a Dios no le caes bien.  \\


interface IAccionistasDao {

    /**
     * Guarda un objeto Accionistas en la base de datos.
     * @param accionistas objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($accionistas);
    /**
     * Modifica un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($accionistas);
    /**
     * Elimina un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($accionistas);
    /**
     * Busca un objeto Accionistas en la base de datos.
     * @param accionistas objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($accionistas);
    /**
     * Lista todos los objetos Accionistas en la base de datos.
     * @return Array<Accionistas> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!