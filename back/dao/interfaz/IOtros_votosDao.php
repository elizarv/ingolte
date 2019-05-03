<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    ¡Me han encontrado! ¡No sé cómo pero me han encontrado!  \\


interface IOtros_votosDao {

    /**
     * Guarda un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($otros_votos);
    /**
     * Modifica un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($otros_votos);
    /**
     * Elimina un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($otros_votos);
    /**
     * Busca un objeto Otros_votos en la base de datos.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($otros_votos);
    /**
     * Lista todos los objetos Otros_votos en la base de datos.
     * @return Array<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Lista todos los objetos Otros_votos en la base de datos que coincidan con la llave primaria.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($otros_votos);
    /**
     * Lista todos los objetos Otros_votos en la base de datos que coincidan con la llave primaria.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($otros_votos);
    /**
     * Lista todos los objetos Otros_votos en la base de datos que coincidan con la llave primaria.
     * @param otros_votos objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Otros_votos> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listById($otros_votos);
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!