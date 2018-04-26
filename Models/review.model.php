<?php

  /**
  * The company page model
  */
  class ReviewModel {

    private $pdo;

    //Atributos
    public $idEmpresa;
    public $testimonio;
    public $fecha;
    public $rating;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener listado de Empresas
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT T.id, E.nombre AS 'empresa', T.testimonio, T.fecha, E.logo, T.rating
                                    FROM tbl_Testimonios T
                                    INNER JOIN tbl_Empresa E
                                    WHERE T.idEmpresa = E.id
                                    ORDER BY T.fecha");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener testimonio por ID
    public function getTestimonio($id) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Testimonios WHERE idEmpresa = ?");

        $stm->execute(array($id));
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Borrar Testimonio
    public function delTestimonio($id) {
      try {
        $stm = $this->pdo->prepare("DELETE FROM tbl_Testimonios WHERE idEmpresa = ?");

        $stm->execute(array($id));
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar datos de Testimonio
    public function updTestimonio($data)	{
      try {
        $sql = "UPDATE tbl_Testimonios SET
                  testimonio = ?,
                  rating = ?
                  WHERE idEmpresa = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->testimonio,
                $data->rating,
                $data->idEmpresa
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Registrar un Testimonio
    public function newTestimonio(ReviewModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Testimonios (idEmpresa,testimonio,fecha,rating) VALUES (?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                    $data->idEmpresa,
                    $data->testimonio,
                    $data->fecha,
                    $data->rating
                  )
                );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si el testimonio existe
    public function checkTestimonio($id) {
      $query = $this->getTestimonio($id);
      //die(print_r(count((array)$query)));

      if(count((array)$query) > 0) {
        return true;
      }
      else {
        return false;
      }
    }

  }
