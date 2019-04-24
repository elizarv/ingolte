<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    El coronel necesitó setenta y cinco años -los setenta y cinco años de su vida, minuto a minuto- para llegar a ese instante. Se sintió puro, explícito, invencible, en el momento de responder:  \\


interface ICandidatoDao {

    /**
     * Guarda un objeto Candidato en la base de datos.
     * @param candidato objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($candidato);
    /**
     * Modifica un objeto Candidato en la base de datos.
     * @param candidato objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($candidato);
    /**
     * Elimina un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($candidato);
    /**
     * Busca un objeto Candidato en la base de datos.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($candidato);
    /**
     * Lista todos los objetos Candidato en la base de datos.
     * @return Array<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
    /**
     * Lista todos los objetos Candidato en la base de datos que coincidan con la llave primaria.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($candidato);
    /**
     * Lista todos los objetos Candidato en la base de datos que coincidan con la llave primaria.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByNumero($candidato);
    /**
     * Lista todos los objetos Candidato en la base de datos que coincidan con la llave primaria.
     * @param candidato objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Candidato> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($candidato);
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!