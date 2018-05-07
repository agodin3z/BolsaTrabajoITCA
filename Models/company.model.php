<?php
require_once 'security.php';
require_once 'pais.model.php';
require_once 'valores.model.php';
require_once 'links.model.php';
require_once 'categoria.model.php';

  /**
  * The company page model
  */
  class CompanyModel {

    private $pdo;

    //Atributos
    public $id;
    public $email;
    public $passwd;
    public $nombre;
    public $categoria;
    public $tel;
    public $email_contact;
    public $dir;
    public $pais;
    public $depto;
    public $ciudad;
    public $descripcion;
    public $about;
    public $mision;
    public $vision;
    public $logo;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }

      $this->security = new Security();
    }

    //Obtener listado de Empresas
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT * FROM tbl_Empresa");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener empresa por ID
    public function getEmpresa($id) {
      try	{
        $stm = $this->pdo->prepare("SELECT * FROM tbl_Empresa WHERE id = ?");

        $stm->execute(array($id));
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener ID Empresa
    public function getID($email) {
      try	{
        $stm = $this->pdo->prepare("SELECT id FROM tbl_Empresa WHERE email = ?");

        $stm->execute(array($email));
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Borrar Empresa
    public function delEmpresa($id) {
      try {
        $stm = $this->pdo->prepare("DELETE FROM tbl_Empresa WHERE id = ?");

        $stm->execute($id);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar datos de Empresa
    public function updEmpresa($data)	{
      //die(print_r($data['categoria']));
      try {
        $sql = "UPDATE tbl_Empresa SET
                  email = ?,
                  categoria = ?,
                  nombre = ?,
                  tel = ?,
                  email_contact = ?,
                  dir = ?,
                  pais = ?,
                  depto = ?,
                  ciudad = ?,
                  descripcion = ?,
                  about = ?,
                  mision = ?,
                  vision = ?
                  WHERE id = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data['email'],
                $data['categoria'],
                $data['nombre'],
                $data['tel'],
                $data['email_contact'],
                $data['dir'],
                $data['pais'],
                $data['depto'],
                $data['ciudad'],
                $data['descripcion'],
                $data['about'],
                $data['mision'],
                $data['vision'],
                $data['id']
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar Contraseña de Empresa
    public function updatePasswd($id, $passwd)	{
      try {
        $sql = "UPDATE tbl_Empresa SET
                  passwd = ?
                  WHERE id = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $passwd,
                $id
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar logo de Empresa
    public function updateLogo($data)	{
      try {
        $sql = "UPDATE tbl_Empresa SET
                  logo = ?
                  WHERE id = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data['logo'],
                $data['id']
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Registrar una Empresa
    public function newEmpresa(CompanyModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Empresa (id,email,passwd,nombre,categoria) VALUES (?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                    $data->id,
                    $data->email,
                    $data->passwd,
                    $data->nombre,
                    $data->categoria
                  )
                );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Verificar login
    public function check_log($email,$passwd) {
      $query = $this->getEmpresa($this->getID($email)->id);

      if(count((array)$query) > 0) {
        if ($this->security->decryptPasswd($passwd) == $this->security->decryptPasswd($query->passwd)) {
          return false;
        } else {
          return true;
        }
      }
      else {
        return true;
      }
    }

    //Verificar si el correo existe
    public function check_email($email) {
      $query = $this->getEmpresa($this->getID($email)->id);
      //die(print_r(count((array)$query)));
      if($_POST['email'] == $query->email) {
        return true;
      }
      else {
        return false;
      }
    }

    public function getOfertasFiltrada($data) {
      try	{
        $result = array();
        $i = 1;
        $sql = "SELECT * FROM tbl_Empresa WHERE id LIKE '%%'";

        //die(print_r($data));
        if (isset($data['categoria'])) {
          $sql .= " AND categoria LIKE ?";
        }
        if (isset($data['nombre'])) {
          $sql .= " AND ( nombre LIKE ?";
        }
        if (isset($data['descripcion'])) {
          $sql .= " OR descripcion LIKE ? )";
        }
        if (isset($data['pais'])) {
          $sql .= " AND pais LIKE ?";
        }

        if (isset($data['depto'])) {
          $sql .= " AND depto LIKE ?";
        }

        $sql .= " ORDER BY nombre DESC";


        $stm = $this->pdo->prepare($sql);

        if (isset($data['categoria'])) {
          $stm->bindValue($i++, "%".$data['categoria']."%", PDO::PARAM_STR);
        }
        if (isset($data['nombre'])) {
          $stm->bindValue($i++, "%".$data['nombre']."%", PDO::PARAM_STR);
        }
        if (isset($data['descripcion'])) {
          $stm->bindValue($i++, "%".$data['descripcion']."%", PDO::PARAM_STR);
        }
        if (isset($data['pais'])) {
          $stm->bindValue($i++, "%".$data['pais']."%", PDO::PARAM_STR);
        }
        if (isset($data['depto'])) {
          $stm->bindValue($i++, "%".$data['depto']."%", PDO::PARAM_STR);
        }

        //die(print_r($stm));
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener total de Ofertas
    public function countOfertas($id) {
      try	{

        $stm = $this->pdo->prepare("SELECT COUNT(id) AS 'total' FROM tbl_Ofertas WHERE idEmpresa = ?");
        $stm->execute(array($id));

        return $stm->fetch(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

  }
