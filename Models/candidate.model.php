<?php
require_once 'security.php';
require_once 'pais.model.php';
require_once 'perfilpro.model.php';
require_once 'idioma.model.php';
require_once 'conocimientos.model.php';
require_once 'habilidades.model.php';
require_once 'estudios.model.php';
require_once 'experiencias.model.php';
require_once 'preferencias.model.php';

  /**
  * The candidate page model
  */
  class CandidateModel {

      private $pdo;
      private $security;

      //Atributos
      public $id;
      public $email;
      public $passwd;
      public $nombre;
      public $apellido;
      public $dui;
      public $fechaNac;
      public $sexo;
      public $idEstado;
      public $pais;
      public $depto;
      public $ciudad;
      public $zip; //XX
      public $dir;
      public $foto;
      public $curriculum;
      public $tel;

      //Contructor
      function __construct() {
        try	{
    			$this->pdo = Database::conexion();
    		}	catch(Exception $e)	{
    			die($e->getMessage());
    		}

        $this->security = new Security();
      }

      //Obtener listado de Personas
    	public function getAll() {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT * FROM tbl_Persona");
    			$stm->execute();

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

    	//Obtener persona por ID
    	public function getPersona($id) {
    		try	{
    			$stm = $this->pdo->prepare("SELECT * FROM tbl_Persona WHERE id = ?");

    			$stm->execute(array($id));
    			return $stm->fetch(PDO::FETCH_OBJ);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

      //Obtener ID Candidato
    	public function getID($email) {
    		try	{
    			$stm = $this->pdo->prepare("SELECT id FROM tbl_Persona WHERE email = ?");

    			$stm->execute(array($email));
    			return $stm->fetch(PDO::FETCH_OBJ);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

    	//Borrar Persona
    	public function delPersona($id) {
    		try {
    			$stm = $this->pdo->prepare("DELETE FROM tbl_Persona WHERE id = ?");

    			$stm->execute($id);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

    	// Actualizar datos de Persona
    	public function updatePersona($data)	{
    		try {
          //die(print_r($data));
    			$sql = "UPDATE tbl_Persona SET
    								nombre = ?,
    								apellido = ?,
                    email = ?,
    								dui = ?,
    								fechaNac = ?,
    								sexo = ?,
                    tel = ?,
    								idEstado = ?,
    								pais = ?,
                    depto = ?,
                    ciudad = ?,
    								zip = ?,
    								dir = ?
    				    		WHERE id = ?";

    			$this->pdo->prepare($sql)
    			     ->execute(
    				    array(
    							$data['nombre'],
    							$data['apellido'],
                  $data['email'],
    							$data['dui'],
    							$data['fechaNac'],
    							$data['sexo'],
                  $data['tel'],
    							$data['idEstado'],
    							$data['pais'],
    							$data['depto'],
    							$data['ciudad'],
    							$data['zip'],
    							$data['dir'],
    							$data['id']
    					)
    				);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

      // Actualizar foto de Persona
    	public function updateFoto($data)	{
    		try {
    			$sql = "UPDATE tbl_Persona SET
    								foto = ?
    				    		WHERE id = ?";

    			$this->pdo->prepare($sql)
    			     ->execute(
    				    array(
    							$data['foto'],
    							$data['id']
    					)
    				);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

      // Actualizar Contraseña de Persona
    	public function updatePasswd($id, $passwd)	{
    		try {
    			$sql = "UPDATE tbl_Persona SET
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

      // Actualizar CV de Persona
    	public function updateCV($data)	{
    		try {
    			$sql = "UPDATE tbl_Persona SET
    								curriculum = ?
    				    		WHERE id = ?";

    			$this->pdo->prepare($sql)
    			     ->execute(
    				    array(
    							$data['curriculum'],
    							$data['id']
    					)
    				);
    		} catch (Exception $e) {
    			die($e->getMessage());
    		}
    	}

    	// Registrar una Persona
    	public function newPersona(CandidateModel $data) { //Registrar
    		try	{
    		$sql = "INSERT INTO tbl_Persona (id,email,passwd,nombre,apellido) VALUES (?, ?, ?, ?, ?)";

    		$this->pdo->prepare($sql)
    		     			->execute(
    								array(
    					          $data->id,
                        $data->email,
    					          $data->passwd,
    					          $data->nombre,
    					          $data->apellido
    					      )
    							);
    		} catch (Exception $e) {
    			//die($e->getMessage());
    		}
    	}

      //Verificar login
      public function check_log($email,$passwd) {
        $query = $this->getPersona($this->getID($email)->id);
        //die(print_r($this->security->decryptPasswd($passwd)));
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
        $query = $this->getPersona($this->getID($email)->id);

        if($_POST['email'] == $query->email) {
          return true;
        }
        else {
          return false;
        }
      }

      //Obtener listado de Estado Civil
    	public function getEstadoCivil() {
    		try	{
    			$result = array();

    			$stm = $this->pdo->prepare("SELECT * FROM tbl_EstadoCivil");
    			$stm->execute();

    			return $stm->fetchAll(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      //Obtener Estado Civil
    	public function getEstado($id) {
    		try	{

    			$stm = $this->pdo->prepare("SELECT nombre FROM tbl_EstadoCivil WHERE id = ?");
    			$stm->execute(array($id));

    			return $stm->fetch(PDO::FETCH_OBJ);
    		} catch(Exception $e)	{
    			die($e->getMessage());
    		}
    	}

      public function getBusquedaFiltrada($data) {
        try	{
          $result = array();
          $i = 1;
          $sql = "SELECT P.foto, P.nombre, P.apellido, P.id, P.pais, P.depto, PP.titulo, PL.situacion FROM tbl_Persona P
                  INNER JOIN tbl_PerfilPro PP INNER JOIN tbl_Preferencias PL WHERE P.id = PP.idPersona AND P.id = PL.idPersona";

          //die(print_r($data));
          if (isset($data['cargo'])) {
            $sql .= " AND titulo LIKE ?";
          }
          if (isset($data['nombre'])) {
            $sql .= " AND ( nombre LIKE ?";
          }
          if (isset($data['apellido'])) {
            $sql .= " OR apellido LIKE ?";
          }
          if (isset($data['situacion'])) {
            $sql .= " OR situacion LIKE ? )";
          }
          if (isset($data['pais'])) {
            $sql .= " AND pais LIKE ?";
          }

          if (isset($data['depto'])) {
            $sql .= " AND P.depto LIKE ?";
          }

          $sql .= " ORDER BY nombre DESC";


          $stm = $this->pdo->prepare($sql);

          if (isset($data['cargo'])) {
            $stm->bindValue($i++, "%".$data['cargo']."%", PDO::PARAM_STR);
          }
          if (isset($data['nombre'])) {
            $stm->bindValue($i++, "%".$data['nombre']."%", PDO::PARAM_STR);
          }
          if (isset($data['apellido'])) {
            $stm->bindValue($i++, "%".$data['apellido']."%", PDO::PARAM_STR);
          }
          if (isset($data['situacion'])) {
            $stm->bindValue($i++, "%".$data['situacion']."%", PDO::PARAM_STR);
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
  }
