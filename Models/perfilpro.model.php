<?php

  /**
  * The perfilpro page model
  */
  class PerfilProModel {
    private $pdo;

    //Atributos
    public $idPersona;
    public $titulo;
    public $descripcion;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar una Persona
    public function newPerfilPro(PerfilProModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_PerfilPro (idPersona,titulo,descripcion) VALUES (?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->titulo,
                      $data->descripcion
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    // Actualizar datos de Persona
    public function updatePerfilPro(PerfilProModel $data)	{
      try {
        $sql = "UPDATE tbl_PerfilPro SET
                  titulo = ?,
                  descripcion = ?
                  WHERE idPersona = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->titulo,
                $data->descripcion,
                $data->idPersona
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Perfil Profesional
    public function getPerfilPro($idPersona) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_PerfilPro WHERE idPersona = ?");

        $stm->execute(array($idPersona));
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener Cargos
    public function getCargos() {
      try	{
        $result = array();
        $stm = $this->pdo->prepare("SELECT DISTINCT titulo FROM tbl_PerfilPro");

        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si el Perfil Profesional existe
    public function check_PerfilPro($idPersona) {
      $query = $this->getPerfilPro($idPersona);

      if(count((array)$query)>1) {
        return false;
      }
      else {
        return true;
      }
    }
  }
