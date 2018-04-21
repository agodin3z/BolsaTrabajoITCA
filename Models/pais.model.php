<?php

  /**
  * The pais model
  */
  class PaisModel {

    private $pdo;

      function __construct() {
        try	{
    			$this->pdo = Database::conexion();
    		}	catch(Exception $e)	{
    			die($e->getMessage());
    		}
      }

      //Obtener listado de Paises
    	public function getPaises() {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT * FROM tbl_Pais ORDER BY nombre");
    			$stm->execute();

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener Pais por ID
    	public function getPais($id) {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT nombre FROM tbl_Pais WHERE id = ?");
    			$stm->execute(array($id));

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener Depto por ID
    	public function getDepto($id) {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT nombre FROM tbl_Departamento WHERE id = ?");
    			$stm->execute(array($id));

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener Municipio por ID
    	public function getMunicipio($id) {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT nombre FROM tbl_Municipio WHERE id = ?");
    			$stm->execute(array($id));

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener listado de Departamentos
    	public function getDeptos($pais) {
    		try	{

    			$result = array();

    			$stm = $this->pdo->prepare("SELECT * FROM tbl_Departamento WHERE pais = ?");
          $stm->execute($pais);

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener listado de Municipios
    	public function getMunicipios($depto) {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT * FROM tbl_Municipio WHERE depto = ?");
          $stm->execute($depto);

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

  }
