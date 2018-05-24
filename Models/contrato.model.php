<?php

  /**
  * The contrato model
  */
  class ContratoModel {

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

    //Obtener listado de Tipos de Contrato
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_TipoContrato");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener nombre del Tipo de Contrato
    public function getName($id) {
      try	{

        $stm = $this->pdo->prepare("SELECT nombre FROM tbl_TipoContrato WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetch(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

  }
