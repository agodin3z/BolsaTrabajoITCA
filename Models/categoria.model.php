<?php

  /**
  * The CatEmpresas model
  */
  class CategoriaModel {

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

    //Obtener listado de Categorias
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_CatEmpresas");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener Categorias por id
    public function getCategoria($id) {
      try	{
        $stm = $this->pdo->prepare("SELECT nombre FROM tbl_CatEmpresas WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetch(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

  }
