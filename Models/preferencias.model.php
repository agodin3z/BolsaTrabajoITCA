<?php

  /**
  * The Preferencias laborales model
  */
  class PreferenciasModel {
    private $pdo;

    //Atributos
    public $idPersona;
    public $situacion;
    public $cargo;
    public $area;
    public $salarioMin;
    public $depto;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar datos de Preferencias
    public function newPreferencias(PreferenciasModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Preferencias (idPersona,situacion,cargo,area,salarioMin,depto) VALUES (?, ?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idPersona,
                      $data->situacion,
                      $data->cargo,
                      $data->area,
                      $data->salarioMin,
                      $data->depto
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    // Actualizar datos de las Preferencias
    public function updatePreferencias(PreferenciasModel $data)	{
      try {

        $sql = "UPDATE tbl_Preferencias SET
                  situacion = ?,
                  cargo = ?,
                  area = ?,
                  salarioMin = ?,
                  depto = ?
                  WHERE idPersona = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->situacion,
                $data->cargo,
                $data->area,
                $data->salarioMin,
                $data->depto,
                $data->idPersona
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener las Preferencias de la persona
    public function getPreferencias($idPersona) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Preferencias WHERE idPersona = ?");

        $stm->execute(array($idPersona));
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si la info existe
    public function check_Preferencias($idPersona) {
      $query = $this->getPreferencias($idPersona);

      if(count((array)$query)>1) {
        return false;
      }
      else {
        return true;
      }
    }
  }
