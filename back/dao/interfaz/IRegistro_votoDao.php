<?php
/*
              -------Creado por-------
             \(x.x )/ Anarchy \( x.x)/
              ------------------------
 */

//    Sólo relájate y deja que alguien más lo haga  \\


interface IRegistro_votoDao {

    /**
     * Guarda un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto a guardar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function insert($registro_voto);
    /**
     * Modifica un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la información a modificar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function update($registro_voto);
    /**
     * Elimina un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function delete($registro_voto);
    /**
     * Busca un objeto Registro_voto en la base de datos.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return El objeto consultado o null
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function select($registro_voto);

  public function countacciones($fecha);
  
    /**
     * Lista todos los objetos Registro_voto en la base de datos.
     * @return Array<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listAll();
  
  public function listResultados($fecha);
    /**
     * Lista todos los objetos Registro_voto en la base de datos que coincidan con la llave primaria.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByCedula($registro_voto);
    /**
     * Lista todos los objetos Registro_voto en la base de datos que coincidan con la llave primaria.
     * @param registro_voto objeto con la(s) llave(s) primaria(s) para consultar
     * @return Array<Registro_voto> Puede contener los objetos consultados o estar vacío
     * @throws NullPointerException Si los objetos correspondientes a las llaves foraneas son null
     */
  public function listByFecha($registro_voto);
    /**
     * Cierra la conexión actual a la base de datos
     */
  public function close();
}
//That´s all folks!
