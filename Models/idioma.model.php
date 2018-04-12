<?php

  /**
  * The idioma page model
  */
  class IdiomaModel {
    private $pdo;

    //Atributos
    public $idPersona;
    public $idIdioma;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar Idioma a Persona
    public function newIdioma(IdiomaModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Idioma_Persona (idPersona,idIdioma) VALUES (?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->idIdioma
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar Idioma de la Persona
    public function delIdioma(IdiomaModel $data)	{
      try {
        $sql = "DELETE FROM tbl_Idioma_Persona WHERE
                  idPersona = ? AND idIdioma = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idPersona,
                $data->idIdioma
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar Idioma de la persona
    public function checkIdiomaPersona(IdiomaModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Idioma_Persona WHERE idPersona = ? AND idIdioma = ?");

        $stm->execute(
              array(
                $data->idPersona,
                $data->idIdioma
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Idiomas
    public function getIdiomas() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Idiomas ORDER BY id");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Idiomas por ID
    public function getIdioma($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT idioma FROM tbl_Idiomas WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Idiomas de la Persona
    public function getIdiomasPer($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Idioma_Persona WHERE idPersona = ? ORDER BY idIdioma");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si los Idiomas existen
    public function check_Idioma($idPersona, $idiomasForm) {
      error_reporting(0); //Quitar error de conversion Array to String

      $idiomasDB = array();

      $query = $this->getIdiomasPer($idPersona); //Idiomas x Persona

      foreach ($query as $idioma) {
        array_push($idiomasDB, array('idIdioma' => $idioma->idIdioma)); //Conversion del Objeto a array
      }

      $delDB = $this->multi_array_diff($idiomasDB, $idiomasForm); //eliminar idiomas en DB
      //die(print_r($delDB));
      if (count((array)$delDB) > 0) {
        foreach ($delDB as $idioma) {
          $data = new IdiomaModel();
          $data->idPersona = $idPersona;
          $data->idIdioma = $idioma['idIdioma'];

          $this->delIdioma($data);
        }
      }

      $insDB = $this->multi_array_diff($idiomasForm, $idiomasDB); //insertar idiomas en DB
      //die(print_r($insDB));
      if (count((array)$insDB) > 0) {
        foreach ($insDB as $idioma) {
          $data = new IdiomaModel();
          $data->idPersona = $idPersona;
          $data->idIdioma = $idioma['idIdioma'];

          $this->newIdioma($data);
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
