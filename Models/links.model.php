<?php

  /**
  * The experiencias laborales model
  */
  class LinksModel {
    private $pdo;

    //Atributos
    public $idEmpresa;
    public $idLink;
    public $url;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    // Registrar link de empresa
    public function newLink(LinksModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_LinksEmpresa (idEmpresa,idLink,url) VALUES (?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                      $data->idEmpresa,
                      $data->idLink,
                      $data->url
                  )
                );
      } catch (Exception $e) {
        //die($e->getMessage());
      }
    }

    //Borrar link de empresa
    public function delLink(LinksModel $data)	{
      try {
        $sql = "DELETE FROM tbl_LinksEmpresa WHERE
                  idEmpresa = ? AND idLink = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data->idEmpresa,
                $data->idLink
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar link de la persona
    public function checkLink(LinksModel $data) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_LinksEmpresa WHERE idEmpresa = ? AND idLink = ?");

        $stm->execute(
              array(
                $data->idEmpresa,
                $data->idLink
            )
          );
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener link por ID
    public function getLink($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_TipoLinks WHERE id = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener tipo de links
    public function getLinkTypes() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_TipoLinks");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener links de la Empresa
    public function getLinks($id) {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_LinksEmpresa WHERE idEmpresa = ?");
        $stm->execute(array($id));

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar si los links existen
    public function check_Links($idEmpresa, $linkForm, $tipo) {
      error_reporting(0); //Quitar error de conversion Array to String

      $linkDB = array();

      if ($tipo == "empresa") {
        $query = $this->getLinks($idEmpresa); //Links de la Empresa

        foreach ($query as $link) {
          $arreglo = array(
            'idEmpresa' => $link->idEmpresa,
            'idLink' => $link->idLink,
            'url' => $link->url
          );
          array_push($linkDB, $arreglo); //Conversion del Objeto a array
        }

        //die(print_r($linkForm));

        $delDB = array_diff_assoc($linkDB, $linkForm); //eliminar Links en DB
        //die(print_r($delDB));
        if (count((array)$delDB) > 0) {
          foreach ($delDB as $link) {
            $data = new LinksModel();
            $data->idEmpresa = $link['idEmpresa'];
            $data->idLink = $link['idLink'];
            $data->url = $link['url'];

            $this->delLink($data);
          }
        }

        $insDB = array_diff_assoc($linkForm, $linkDB); //insertar Links en DB
        //die(print_r($insDB));
        if (count((array)$insDB) > 0) {
          foreach ($insDB as $link) {
            $data = new LinksModel();
            $data->idEmpresa = $link['idEmpresa'];
            $data->idLink = $link['idLink'];
            $data->url = $link['url'];

            $this->newLink($data);
          }
        }

      }
    }
  }
