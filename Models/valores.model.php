<?php

  /**
  * The experiencias laborales model
  */
  class ValoresModel {
    private $pdo;

    //Atributos
    public $idEmpresa;
    public $valor;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar valor de empresa
    public function newValor(ValoresModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_ValoresEmpresa (idEmpresa,valor) VALUES (?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idEmpresa,
                      $data->valor
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar valor de empresa
    public function delValor(ValoresModel $data)	{
      try {
        $sql = "DELETE FROM tbl_ValoresEmpresa WHERE
                  idEmpresa = ? AND valor = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idEmpresa,
                $data->valor
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar exp de la persona
    public function checkValor(ValoresModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_ValoresEmpresa WHERE idEmpresa = ? AND valor = ? ORDER BY valor");

        $stm->execute(
              array(
                $data->idEmpresa,
                $data->valor
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp por ID
    public function getValor($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_ValoresEmpresa WHERE id = ?  ORDER BY valor");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp de la Persona
    public function getValores($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_ValoresEmpresa WHERE idEmpresa = ? ORDER BY valor");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si las exp existen
    public function check_Valores($idEmpresa, $valForm) {
      error_reporting(0); //Quitar error de conversion Array to String

      $valDB = array();

      $query = $this->getValores($idEmpresa); //Valores de la Empresa

      foreach ($query as $val) {
        $arreglo = array(
          'idEmpresa' => $val->idEmpresa,
          'valor' => $val->valor
        );
        array_push($valDB, $arreglo); //Conversion del Objeto a array
      }

      //die(print_r($valForm));
      //die(print_r('Algo: ').print_r($this->multi_array_diff($valForm, $valDB)));

      $delDB = $this->multi_array_diff($valDB, $valForm); //eliminar valor en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $val) {
          $data = new ValoresModel();
          $data->idEmpresa = $val['idEmpresa'];
          $data->valor = $val['valor'];

          $this->delValor($data);
        }
      }

      $insDB = $this->multi_array_diff($valForm, $valDB); //insertar valor en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $val) {
          $data = new ValoresModel();
          $data->idEmpresa = $val['idEmpresa'];
          $data->valor = $val['valor'];

          $this->newValor($data);
        }
      }

    }

    // Custom Array Diff para Arreglos Multidimensionales
    private function multi_array_diff($a, $b) {
      foreach ($a as $key => $value) {
        if (in_array($value, $b)) {
          unset($a[$key]);
        }
      }
      return $a;
    }

  }
