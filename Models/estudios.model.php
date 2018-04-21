<?php

  /**
  * The experiencias laborales model
  */
  class EstudiosModel {
    private $pdo;

    //Atributos
    public $id;
    public $idPersona;
    public $institucion;
    public $nivel;
    public $inicio;
    public $fin;
    public $notas;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar exp a Persona
    public function newEstudio(EstudiosModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Estudios (idPersona,institucion,nivel,inicio,fin,notas) VALUES (?, ?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->institucion,
                      $data->nivel,
                      $data->inicio,
                      $data->fin,
                      $data->notas
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar exp de la Persona
    public function delEstudio(EstudiosModel $data)	{
      try {
        $sql = "DELETE FROM tbl_Estudios WHERE
                  idPersona = ? AND institucion = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idPersona,
                $data->institucion
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar exp de la persona
    public function checkEstudio(EstudiosModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Estudios WHERE idPersona = ? AND institucion = ?");

        $stm->execute(
              array(
                $data->idPersona,
                $data->institucion
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp por ID
    public function getEstudio($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Estudios WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener exp de la Persona
    public function getEstudios($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Estudios WHERE idPersona = ? ORDER BY fin");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si las exp existen
    public function check_Estudios($idPersona, $estForm) {
      //error_reporting(0); //Quitar error de conversion Array to String

      $estDB = array();

      $query = $this->getEstudios($idPersona); //Habilidades de la Persona

      foreach ($query as $est) {
        $arreglo = array(
          'idPersona' => $est->idPersona,
          'institucion' => $est->institucion,
          'nivel' => $est->nivel,
          'inicio' => $est->inicio,
          'fin' => $est->fin,
          'notas' => $est->notas
        );
        array_push($estDB, $arreglo); //Conversion del Objeto a array
      }

      //die(print_r($estForm));

      $delDB = $this->multi_array_diff($estDB, $estForm); //eliminar habilidad en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $est) {
          $data = new EstudiosModel();
          $data->idPersona = $est['idPersona'];
          $data->institucion = $est['institucion'];
          $data->nivel = $est['nivel'];
          $data->inicio = $est['inicio'];
          $data->fin = $est['fin'];
          $data->notas = $est['notas'];

          $this->delEstudio($data);
        }
      }

      $insDB = $this->multi_array_diff($estForm, $estDB); //insertar habilidad en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $est) {
          $data = new EstudiosModel();
          $data->idPersona = $est['idPersona'];
          $data->institucion = $est['institucion'];
          $data->nivel = $est['nivel'];
          $data->inicio = $est['inicio'];
          $data->fin = $est['fin'];
          $data->notas = $est['notas'];

          $this->newEstudio($data);
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
