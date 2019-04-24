<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    No es una cola ni es una pila, es tu proyecto que no compila  \\


interface IListaDao {

    /**
     * Guarda un objeto Lista en la base de datos.
     * @param lista objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($lista);
    /**
     * Modifica un objeto Lista en la base de datos.
     * @param lista objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($lista);
    /**
     * Elimina un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($lista);
    /**
     * Busca un objeto Lista en la base de datos.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($lista);
    /**
     * Lista todos los objetos Lista en la base de datos.
     * @return Array<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Lista todos los objetos Lista en la base de datos que coincidan con la llave primaria.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($lista);
    /**
     * Lista todos los objetos Lista en la base de datos que coincidan con la llave primaria.
     * @param lista objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Lista> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByNumero($lista);
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!