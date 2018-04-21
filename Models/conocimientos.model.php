<?php

  /**
  * The programaes model
  */
  class ConocimientosModel {
    private $pdo;

    //Atributos
    public $idPersona;
    public $programa;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar programa a Persona
    public function newConocimiento(ConocimientosModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Conocimientos (idPersona,programa) VALUES (?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->programa
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar programa de la Persona
    public function delConocimiento(ConocimientosModel $data)	{
      try {
        $sql = "DELETE FROM tbl_Conocimientos WHERE
                  idPersona = ? AND programa = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idPersona,
                $data->programa
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar programa de la persona
    public function checkConocimiento(ConocimientosModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Conocimientos WHERE idPersona = ? AND programa = ?");

        $stm->execute(
              array(
                $data->idPersona,
                $data->programa
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Habilidad por ID
    public function getConocimiento($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT programa FROM tbl_Conocimientos WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener programas de la Persona
    public function getConocimientos($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Conocimientos WHERE idPersona = ? ORDER BY programa");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si las programaes existen
    public function check_Conocimientos($idPersona, $programsForm) {
      error_reporting(0); //Quitar error de conversion Array to String

      $programsDB = array();

      $query = $this->getConocimientos($idPersona); //Conocimientos de la Persona

      foreach ($query as $program) {
        array_push($programsDB, array('programa' => $program->programa)); //Conversion del Objeto a array
      }

      $delDB = $this->multi_array_diff($programsDB, $programsForm); //eliminar programa en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $program) {
          $data = new ConocimientosModel();
          $data->idPersona = $idPersona;
          $data->programa = $program['programa'];

          $this->delConocimiento($data);
        }
      }

      $insDB = $this->multi_array_diff($programsForm, $programsDB); //insertar programa en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $program) {
          $data = new ConocimientosModel();
          $data->idPersona = $idPersona;
          $data->programa = $program['programa'];

          $this->newConocimiento($data);
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
