<?php

  /**
  * The habilidades model
  */
  class HabilidadesModel {
    private $pdo;

    //Atributos
    public $idPersona;
    public $habilidad;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar habilidad a Persona
    public function newHabilidad(HabilidadesModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Habilidades (idPersona,habilidad) VALUES (?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->habilidad
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar habilidad de la Persona
    public function delHabilidad(HabilidadesModel $data)	{
      try {
        $sql = "DELETE FROM tbl_Habilidades WHERE
                  idPersona = ? AND habilidad = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idPersona,
                $data->habilidad
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar habilidad de la persona
    public function checkHabilidad(HabilidadesModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Habilidades WHERE idPersona = ? AND habilidad = ?");

        $stm->execute(
              array(
                $data->idPersona,
                $data->habilidad
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Habilidad por ID
    public function getHabilidad($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT habilidad FROM tbl_Habilidades WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener habilidades de la Persona
    public function getHabilidades($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Habilidades WHERE idPersona = ? ORDER BY habilidad");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si las habilidades existen
    public function check_Habilidades($idPersona, $skillForm) {
      error_reporting(0); //Quitar error de conversion Array to String

      $skillDB = array();

      $query = $this->getHabilidades($idPersona); //Habilidades de la Persona

      foreach ($query as $skill) {
        array_push($skillDB, array('habilidad' => $skill->habilidad)); //Conversion del Objeto a array
      }

      $delDB = $this->multi_array_diff($skillDB, $skillForm); //eliminar habilidad en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $skill) {
          $data = new HabilidadesModel();
          $data->idPersona = $idPersona;
          $data->habilidad = $skill['habilidad'];

          $this->delHabilidad($data);
        }
      }

      $insDB = $this->multi_array_diff($skillForm, $skillDB); //insertar habilidad en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $skill) {
          $data = new HabilidadesModel();
          $data->idPersona = $idPersona;
          $data->habilidad = $skill['habilidad'];

          $this->newHabilidad($data);
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
