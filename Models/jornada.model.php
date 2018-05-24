<?php

  /**
  * The jornada model
  */
  class JornadaModel {

    private $pdo;

    //Atributos
    public $id;
    public $nombre;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener listado de Jornadas
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Jornada");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }        

  }
