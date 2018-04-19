<?php

  /**
  * The experiencias laborales model
  */
  class ExperienciasModel {
    private $pdo;

    //Atributos
    public $id;
    public $idPersona;
    public $empresa;
    public $cargo;
    public $inicio;
    public $fin;
    public $funciones;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar exp a Persona
    public function newExperiencia(ExperienciasModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Experiencias (idPersona,empresa,cargo,inicio,fin,funciones) VALUES (?, ?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->empresa,
                      $data->cargo,
                      $data->inicio,
                      $data->fin,
                      $data->funciones
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar exp de la Persona
    public function delExperiencia(ExperienciasModel $data)	{
      try {
        $sql = "DELETE FROM tbl_Experiencias WHERE
                  idPersona = ? AND empresa = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idPersona,
                $data->empresa
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar exp de la persona
    public function checkExperiencia(ExperienciasModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Experiencias WHERE idPersona = ? AND empresa = ?");

        $stm->execute(
              array(
                $data->idPersona,
                $data->empresa
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp por ID
    public function getExperiencia($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Experiencias WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp de la Persona
    public function getExperiencias($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Experiencias WHERE idPersona = ? ORDER BY fin");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si las exp existen
    public function check_Experiencias($idPersona, $expForm) {
      error_reporting(0); //Quitar error de conversion Array to String

      $expDB = array();

      $query = $this->getExperiencias($idPersona); //Habilidades de la Persona

      foreach ($query as $exp) {
        $arreglo = array(
          'idPersona' => $exp->idPersona,
          'empresa' => $exp->empresa,
          'cargo' => $exp->cargo,
          'inicio' => $exp->inicio,
          'fin' => $exp->fin,
          'funciones' => $exp->funciones
        );
        array_push($expDB, $arreglo); //Conversion del Objeto a array
      }

      //die(print_r($expDB));

      $delDB = $this->multi_array_diff($expDB, $expForm); //eliminar habilidad en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $exp) {
          $data = new ExperienciasModel();
          $data->idPersona = $exp['idPersona'];
          $data->empresa = $exp['empresa'];
          $data->cargo = $exp['cargo'];
          $data->inicio = $exp['inicio'];
          $data->fin = $exp['fin'];
          $data->funciones = $exp['funciones'];

          $this->delExperiencia($data);
        }
      }

      $insDB = $this->multi_array_diff($expForm, $expDB); //insertar habilidad en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $exp) {
          $data = new ExperienciasModel();
          $data->idPersona = $exp['idPersona'];
          $data->empresa = $exp['empresa'];
          $data->cargo = $exp['cargo'];
          $data->inicio = $exp['inicio'];
          $data->fin = $exp['fin'];
          $data->funciones = $exp['funciones'];

          $this->newExperiencia($data);
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
