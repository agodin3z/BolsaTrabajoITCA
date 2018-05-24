<?php
require_once 'jornada.model.php';
require_once 'contrato.model.php';
require_once 'categoria.model.php';
  /**
  * The jobs page model
  */
  class JobsModel {

    private $pdo;

    //Atributos
    public $id;
    public $idEmpresa;
    public $titulo;
    public $area;
    public $cargo;
    public $contrato;
    public $jornada;
    public $categoria;
    public $email;
    public $salario;
    public $localizacion;
    public $descripcion;
    public $vacantes;
    public $educacionMin;
    public $edad;
    public $viajar;
    public $residencia;
    public $imagen;
    public $fechaPub;

    //Contructor
    function __construct() {
      try	{
        $this->pdo = Database::conexion();
      }	catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener listado de Ofertas
    public function getAll() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT O.id,O.idEmpresa,O.titulo,O.area,O.cargo,O.contrato,O.jornada,O.categoria,O.email,
                                          O.salario,O.localizacion,O.descripcion,O.vacantes,O.educacionMin,O.edad,O.viajar,
                                          O.residencia,O.fechaPub, E.nombre AS 'empresa', C.nombre AS 'tipoContrato',
                                          J.nombre AS 'tipoJornada', CE.nombre AS 'catOferta', E.logo AS 'logo' FROM tbl_Ofertas O INNER JOIN tbl_Empresa E
                                          INNER JOIN tbl_Jornada J INNER JOIN tbl_TipoContrato C INNER JOIN tbl_CatEmpresas CE
                                          WHERE O.idEmpresa = E.id AND O.contrato = C.id AND O.jornada = J.id AND O.categoria = CE.id
                                          ORDER BY fechaPub DESC");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener listado de Ofertas
    public function getCategorias() {
      try	{
        $result = array();

        $stm = $this->pdo->prepare("SELECT DISTINCT O.categoria, CE.nombre AS 'catOferta' FROM tbl_Ofertas O INNER JOIN tbl_CatEmpresas CE
                                          WHERE O.categoria = CE.id ORDER BY CE.nombre");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener total de Ofertas
    public function countOfertas() {
      try	{

        $stm = $this->pdo->prepare("SELECT COUNT(id) AS 'total' FROM tbl_Ofertas");
        $stm->execute();

        return $stm->fetch(PDO::FETCH_OBJ);
      } catch(Exception $e)	{
        die($e->getMessage());
      }
    }

    //Obtener oferta por ID
    public function getOferta($id) {
      try	{
        $stm = $this->pdo->prepare("SELECT O.id,O.idEmpresa,O.titulo,O.area,O.cargo,O.contrato,O.jornada,O.categoria,O.email,
                                          O.salario,O.localizacion,O.descripcion,O.vacantes,O.educacionMin,O.edad,O.viajar,
                                          O.residencia,O.imagen,O.fechaPub, E.nombre AS 'empresa', C.nombre AS 'tipoContrato',
                                          J.nombre AS 'tipoJornada', CE.nombre AS 'catOferta' FROM tbl_Ofertas O INNER JOIN tbl_Empresa E
                                          INNER JOIN tbl_Jornada J INNER JOIN tbl_TipoContrato C INNER JOIN tbl_CatEmpresas CE
                                          WHERE O.idEmpresa = E.id AND O.contrato = C.id AND O.jornada = J.id AND O.categoria = CE.id
                                          ORDER BY fechaPub DESC");

        $stm->execute(array($id));
        return $stm->fetch(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener oferta por ID
    public function getRelated($id,$cat) {
      try	{
        $result = array();
        $stm = $this->pdo->prepare("SELECT O.id,O.idEmpresa,O.titulo,O.area,O.cargo,O.contrato,O.jornada,O.categoria,O.email,
                                          O.salario,O.localizacion,O.descripcion,O.vacantes,O.educacionMin,O.edad,O.viajar,
                                          O.residencia,O.imagen,O.fechaPub, E.nombre AS 'empresa', E.logo, C.nombre AS 'tipoContrato',
                                          J.nombre AS 'tipoJornada', CE.nombre AS 'catOferta' FROM tbl_Ofertas O INNER JOIN tbl_Empresa E
                                          INNER JOIN tbl_Jornada J INNER JOIN tbl_TipoContrato C INNER JOIN tbl_CatEmpresas CE
                                          WHERE O.idEmpresa = E.id AND O.contrato = C.id AND O.jornada = J.id AND O.categoria = CE.id
                                          AND O.categoria = ? AND O.id != ? ORDER BY fechaPub DESC");

        $stm->execute(array($cat,$id));
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener ofertas por filtro
    public function getOfertasFiltrada($data) {
      try	{
        $result = array();
        $i = 1;
        $sql = "SELECT O.id,O.idEmpresa,O.titulo,O.area,O.contrato,O.jornada,O.categoria,O.salario,O.localizacion,O.descripcion,
                      O.fechaPub, E.nombre AS 'empresa', C.nombre AS 'tipoContrato', E.logo AS 'logo', J.nombre AS 'tipoJornada',
                      CE.nombre AS 'catOferta' FROM tbl_Ofertas O INNER JOIN tbl_Empresa E INNER JOIN tbl_Jornada J
                      INNER JOIN tbl_TipoContrato C INNER JOIN tbl_CatEmpresas CE
                      WHERE O.idEmpresa = E.id AND O.contrato = C.id AND O.jornada = J.id AND O.categoria = CE.id";

        //die(print_r($data));
        if (isset($data['categoria'])) {
          $sql .= " AND O.categoria LIKE ?";
        }
        if (isset($data['titulo'])) {
          $sql .= " AND ( O.titulo LIKE ?";
        }
        if (isset($data['descripcion'])) {
          $sql .= " OR O.descripcion LIKE ? )";
        }
        if (isset($data['localizacion'])) {
          $sql .= " AND O.localizacion LIKE ?";
        }

        $sql .= " ORDER BY O.fechaPub DESC";


        $stm = $this->pdo->prepare($sql);

        if (isset($data['categoria'])) {
          $stm->bindValue($i++, "%".$data['categoria']."%", PDO::PARAM_STR);
        }
        if (isset($data['titulo'])) {
          $stm->bindValue($i++, "%".$data['titulo']."%", PDO::PARAM_STR);
        }
        if (isset($data['descripcion'])) {
          $stm->bindValue($i++, "%".$data['descripcion']."%", PDO::PARAM_STR);
        }
        if (isset($data['localizacion'])) {
          $stm->bindValue($i++, "%".$data['localizacion']."%", PDO::PARAM_STR);
        }

        //die(print_r($stm));
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Obtener ofertas por empresa
    public function getOfertasEmpresa($data) {
      try	{
        $result = array();
        $i = 1;
        $sql = "SELECT O.id,O.idEmpresa,O.titulo,O.area,O.contrato,O.jornada,O.categoria,O.salario,O.localizacion,O.descripcion,
                      O.fechaPub, E.nombre AS 'empresa', C.nombre AS 'tipoContrato', E.logo AS 'logo', J.nombre AS 'tipoJornada',
                      CE.nombre AS 'catOferta' FROM tbl_Ofertas O INNER JOIN tbl_Empresa E INNER JOIN tbl_Jornada J
                      INNER JOIN tbl_TipoContrato C INNER JOIN tbl_CatEmpresas CE WHERE O.idEmpresa = E.id AND O.contrato = C.id
                      AND O.jornada = J.id AND O.categoria = CE.id AND O.idEmpresa = ? ORDER BY O.fechaPub DESC";

        //die(print_r($data));

        $stm = $this->pdo->prepare($sql);

        //die(print_r($stm));
        $stm->execute(array($data));
        return $stm->fetchAll(PDO::FETCH_OBJ);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    //Borrar Oferta
    public function delOferta($id) {
      try {
        $stm = $this->pdo->prepare("DELETE FROM tbl_Ofertas WHERE id = ?");

        $stm->execute($id);
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar datos de la Oferta
    public function updOferta($data)	{
      try {
        $sql = "UPDATE tbl_Ofertas SET
                  titulo = ?,
                  area = ?,
                  cargo = ?,
                  contrato = ?,
                  jornada = ?,
                  categoria = ?,
                  email = ?,
                  salario = ?,
                  localizacion = ?,
                  descripcion = ?,
                  vacantes = ?,
                  educacionMin = ?,
                  edad = ?,
                  viajar = ?,
                  residencia = ?
                  WHERE id = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data['titulo'],
                $data['area'],
                $data['cargo'],
                $data['contrato'],
                $data['jornada'],
                $data['categoria'],
                $data['email'],
                $data['salario'],
                $data['localizacion'],
                $data['descripcion'],
                $data['vacantes'],
                $data['educacionMin'],
                $data['edad'],
                $data['viajar'],
                $data['residencia'],
                $data['id']
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Actualizar imagen de oferta
    public function updateImg($data)	{
      try {
        $sql = "UPDATE tbl_Ofertas SET
                  imagen = ?
                  WHERE id = ?";

        $this->pdo->prepare($sql)
             ->execute(
              array(
                $data['imagen'],
                $data['id']
            )
          );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

    // Registrar una Oferta
    public function newOferta(JobsModel $data) { //Registrar
      try	{
      $sql = "INSERT INTO tbl_Ofertas
                    (id,idEmpresa,titulo,area,cargo,contrato,jornada,categoria,email,salario,localizacion,descripcion,vacantes,educacionMin,edad,viajar,residencia,imagen,fechaPub)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $this->pdo->prepare($sql)
                ->execute(
                  array(
                    $data->id,
                    $data->idEmpresa,
                    $data->titulo,
                    $data->area,
                    $data->cargo,
                    $data->contrato,
                    $data->jornada,
                    $data->categoria,
                    $data->email,
                    $data->salario,
                    $data->localizacion,
                    $data->descripcion,
                    $data->vacantes,
                    $data->educacionMin,
                    $data->edad,
                    $data->viajar,
                    $data->residencia,
                    $data->imagen,
                    $data->fechaPub
                  )
                );
      } catch (Exception $e) {
        die($e->getMessage());
      }
    }

  }
