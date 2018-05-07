<?php
//Load Mailer
require_once 'mailer.controller.php';

  /**
  * The company page controller
  */
  class CompanyController {
      private $model;
      private $modelPais;
      private $modelValor;
      private $modelLink;
      private $modelCat;
      private $security;

      function __construct() {
          $this->model = new CompanyModel();
          $this->modelPais = new PaisModel();
          $this->modelValor = new ValoresModel();
          $this->modelLink = new LinksModel();
          $this->modelCat = new CategoriaModel();
          $this->security = new Security();
          $this->mailer = new MailerController();
      }

      //Cargar Vista de Login
      public function loadView() {
        $title = "Acceso Empresas";
        $categorias = $this->modelCat->getAll();
        require_once 'Views/pages/company_log_reg.php';
      }

      //Cargar Vista de Olvidó la contraseña
      public function loadForgotPass() {
        $title = "¿Olvidó la Clave?";
        require_once 'Views/pages/lost-password.php';
      }

      public function loadUpdPasswd() {
        $title = "Cambio de contraseña";
        require_once 'Views/pages/change-password.php';
      }

      //Cargar Perfil
      public function loadProfile() {
        $empresa = $_SESSION['company'];
        $this->renderProfile($empresa,'Perfil');
      }

      //Cargar Perfil de una empresa específica
      public function showProfile($id) {
        $empresa = new CompanyModel();
        foreach ($this->model->getAll() as $i) {
          if ($id[0] == substr(md5($i->id), 0, 8)) {
            $empresa = $i;
          }
        }
        if (!empty($empresa->id)) {
          $this->renderProfile($empresa,'');
        } else {
          $title = "Page Not Found";
          require_once 'Views/pages/404.php';
        }
      }

      //Carga la vista del perfil
      private function renderProfile($empresa,$t) {
        $title = $empresa->nombre;
        if (!empty($t)) { $title = $t; }
        $links = $this->modelLink->getLinks($empresa->id);
        $valores = $this->modelValor->getValores($empresa->id);
        $categoria = $this->modelCat->getCategoria($empresa->categoria)->nombre;
        //die(print_r($empresa->categoria));
        require_once 'Views/pages/company-profile.php';
      }

      //Cargar Empresas
      public function loadCompanies() {
        $title = "Empresas";
        $lista = $this->model->getAll();
        require_once 'Views/pages/companies.php';
      }

      //Registrar empresa
      public function registerCompany() {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['passwd'])) {
          $this->newCompany();
        } else {
          //session_start();
          $_SESSION['register_err'] = array(true,"Error al crear la cuenta!");
          header('Location: /company/login');
        }
      }

      // Cargar Ajustes de la cuenta
      public function loadSettings() {
        $title = "Editar Perfil";
        $paises = $this->modelPais->getPaises();
        $tipos = $this->modelLink->getLinkTypes();
        $links = $this->modelLink->getLinks($_SESSION['company']->id);
        $valores = $this->modelValor->getValores($_SESSION['company']->id);
        $categorias = $this->modelCat->getAll();
        require_once 'Views/pages/submit-company.php';
      }

      // Guardar Empresa
      private function newCompany(){
          if (strlen($_POST['passwd']) <= 16) {
            $data = $this->model->check_email($_POST['email']);

        	  if($data > 0)  {
              //die(print_r("nope"));
              $_SESSION["register_err"] = array(true, "Error el email ya se encuentra registrado!");
              header("Location: /company/login");
            }
        	  else{
              //die(print_r("pasa"));
              $empresa = new CompanyModel();

              $empresa->id = $this->genID($_POST['nombre']);
              $empresa->email = $_POST['email'];
              $empresa->passwd = $this->security->encryptPasswd($_POST['passwd']);
              $empresa->nombre = $_POST['nombre'];
              $empresa->categoria = $_POST['categoria'];

              //die(print_r($empresa));
              $this->model->newEmpresa($empresa);
              $_SESSION['register_err'] = array(false,"El registro fue exitoso!");
        	  }

          } else {
            $_SESSION['register_err'] = array(true,"La contraseña no debe tener más de 16 caracteres!");
          }

          header('Location: /company/login');
      }

      // Eliminar empresa
      public function delCompany($id){
          $this->model->delEmpresa($id);
          header('Location: /company/logout');
      }

      //Actualizar empresa
      public function updCompany(){
      if (empty($_POST['nombre']) || empty($_POST['email'])) {
          $_SESSION['register_err'] = array(true,"Un campo requerido esta vacío!");
        } else {
          //die(print_r($_POST['habilidad']));
          $empresa = array(
            'nombre'=>$_POST['nombre'],
            'email'=>$_POST['email'],
            'categoria'=>$_POST['categoria'],
            'tel'=>$_POST['tel'],
            'email_contact'=>$_POST['email_contact'],
            'dir'=>$_POST['dir'],
            'pais'=>$_POST['pais'],
            'depto'=>(isset($_POST['depto']) && !empty($_POST['depto'])) ? $_POST['depto'] : "",
            'ciudad'=>(isset($_POST['ciudad']) && !empty($_POST['ciudad'])) ? $_POST['ciudad'] : "",
            'descripcion'=>$_POST['descripcion'],
            'about'=>$_POST['about'],
            'mision'=>$_POST['mision'],
            'vision'=>$_POST['vision'],
            'id'=>$_SESSION['company']->id
      	  );

          //die(print_r($empresa));

          $data = $this->model->updEmpresa($empresa);
          $this->updateValores();
          $this->updateLinks();

          //die(print_r($_FILES['foto']));
          if (isset($_FILES['logo'])) {
            $this->upLogo();
          }

      	  if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al actualizar los datos!");
          }
      	  else{
            $_SESSION['register_err'] = array(false,"Actualización de datos exitoso!");
            $company = $this->model->getEmpresa($empresa['id']);
            $_SESSION['company'] = $company;
      	  }
        }

          header("Location: /company/settings");
      }

      // Actualiza los valores de la empresa
      public function updateValores() {
        $valores = array();

        if (isset($_POST['valor'])) {
          foreach ($_POST['valor'] as $i) {
            array_push($valores, array('idEmpresa' => $_SESSION['company']->id, 'valor' => $i));
          }
        }

        $this->modelValor->check_Valores($_SESSION['company']->id,$valores);
      }

      //Actualiza datos de redes sociales / websites
      public function updateLinks() {
        $links = array();

        //die(print_r($_POST['idLink']));

        if (isset($_POST['idLink']) && isset($_POST['url'])) {
          for ($i=0; $i < count($_POST['url']); $i++) {
            if (!empty($_POST['idLink'][$i]) && !empty($_POST['url'][$i])) {
              array_push($links, array('idEmpresa' => $_SESSION['company']->id,'idLink' => $_POST['idLink'][$i], 'url' => $_POST['url'][$i]));
            }
          }
        }

        $this->modelLink->check_Links($_SESSION['company']->id,$links,"empresa");
      }

      //Generar ID basado en el nombre y la fecha de registro
      private function genID($name) {
        $fecha = getdate();
        return strtoupper(substr(trim($name), 0, 3).$fecha['hours'].$fecha['minutes'].$fecha['seconds']);
      }

      //Hacer login
      public function login_user(){
    	  $empresa = array(
    	  	'email' => $_POST['email'],
    	  	'passwd' => $this->security->encryptPasswd($_POST['password'])
    	  );

    	  $data = $this->model->check_log($empresa['email'],$empresa['passwd']);

    	  if($data > 0)  {
          $_SESSION["register_err"] = array(true, "Error en el email o contraseña!");
          header("Location: /company/login");
        }
    	  else{
          $company = $this->model->getEmpresa($this->model->getID($empresa['email'])->id);
          $_SESSION['company'] = $company;
          $_SESSION["company_name"] = $company->nombre;
          header("Location: /company");
    	  }
    	}

      //Subir Logotipo
      public function upLogo() {
        $permitido = array('jpeg', 'jpg', 'gif', 'png');

        if (isset($_FILES['logo'])) {
            $tmp_name = $_FILES["logo"]["tmp_name"];

            if (is_uploaded_file($tmp_name)) {

                $nombre = $_FILES["logo"]["name"];
                $name = "./assets/images/logos/".$_SESSION['company']->id."_".$nombre;
                $extension=substr(strrchr($name, '.'), 1);
                //die(print_r($name));
                if (in_array($extension, $permitido)) { // Solo admite imagenes
                    if (is_file($name)) { //si existe el archivo
                        $idUnico = time();
                        $name = "./assets/images/logos/".$_SESSION['company']->id."_".$idUnico."-".$nombre;
                    }
                    unlink($_SESSION['company']->logo);
                    move_uploaded_file($tmp_name, $name);

                    $this->model->updateLogo(array('id' => $_SESSION['company']->id, 'logo' => $name));
                    //$_SESSION['register_err'] = array(false,"Imagen Subida.");

                } else {
                  $_SESSION['register_err'] = array(true,"El tipo de archivo no es permitido.");
                }

            } else {
              $_SESSION['register_err'] = array(true,"Error al subir la imagen.");
            }
        }
      }

      //realizar una busqueda filtrada de Ofertas
      public function doSearch() {
        $search = array();
        if (isset($_GET['cat']) && !empty($_GET['cat'])) {
          $search['categoria'] = $_GET['cat'];
        }

        if (isset($_GET['key']) && !empty($_GET['key'])) {
          $search['nombre'] = $_GET['key'];
          $search['descripcion'] = $_GET['key'];
        }

        if (isset($_GET['pais']) && !empty($_GET['pais'])) {
          $search['pais'] = $_GET['pais'];
        }

        if (isset($_GET['depto']) && !empty($_GET['depto'])) {
          $search['depto'] = $_GET['depto'];
        }

        if (count($search) > 0) {
          //die(print_r($this->model->getOfertasFiltrada($search)));
          $title = "Resultado de búsqueda";
          $lista = $this->model->getOfertasFiltrada($search);
          //die(print_r(count($lista)));
          require_once 'Views/pages/companies.php';
        } else {
          header('Location: /company/list');
        }
      }

      //Resetear password
      public function resetPasswd() {
        $email  = strtolower(trim($_POST['email']));

        $data=$this->model->check_email(trim($_POST['email']));

        if($data > 0)  {
          $dat=$this->model->getEmpresa($this->model->getID($email)->id);

          //genPasswd
          $newPasswd = strrev(substr(base64_encode(md5($this->genID(substr($email, 0,3),substr($dat->id, 2,3)))), 0, 10));

          $message = "¡Hola!<br><br>
          Haz solicitado una recuperación de contraseña para esta dirección de correo electrónico: $dat->email <br>
          Si no tiene idea de qué trata este mensaje, ignórelo.<br><br>
          Email: $dat->email <br>
          Nueva contraseña: $newPasswd <br><br>
          Inicie sesión en ITCA Jobs aquí: https://".DOMAIN."/company/login <br><br>
          Gracias,<br>
          ITCA Jobs";

          $passwd = $this->security->encryptPasswd($newPasswd);

          //die(print($passwd));
          //Update passwd
          $data=$this->model->updatePasswd($dat->id,$passwd);
          if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al resetar la contraseña!");
          }
      	  else{
            //Email
            $this->mailer->send(
              NOTIFY_EMAIL,  //From
              NOTIFY_NAME,
              $email,        //To
              '',
              NOTIFY_EMAIL,        //reply
              'no-reply',
              'Solicitud de restablecimiento de contraseña',
              $message,
              ''
            );
      	  }
        }
        else{
          $_SESSION["register_err"] = array(true, "Error el email no se encuentra asociado a ninguna cuenta!");
        }
        header("Location: /company/login");
      }

      //Cambiar la contraseña
      public function changePasswd() {
        $old = $_POST['old_passwd'];
        $new = $_POST['new_passwd'];
        //die(print_r($old));
        $data = $this->model->check_log($_SESSION['company']->email, $this->security->encryptPasswd($old));

    	  if($data > 0)  {
          $_SESSION["register_err"] = array(true, "Error en la contraseña anterior!");
        }
    	  else{
          $data = $this->model->updatePasswd($_SESSION['company']->id, $this->security->encryptPasswd($new));
          if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al cambiar la contraseña!");
          }
          else{
            $_SESSION["register_err"] = array(false, "Contraseña cambiada correctamente!");
          }
    	  }
        header("Location: /company/change_passwd");
      }


      public function getDeptos($pais) {
        //die(print_r(json_encode((array)$this->modelPais->getDeptos($pais))));
        header("Content-type: application/json; charset=utf-8");
        print json_encode((array)$this->modelPais->getDeptos($pais));
      }
      public function getMunicp($depto) {
        //die(print_r(json_encode((array)$this->modelPais->getDeptos($pais))));
        header("Content-type: application/json; charset=utf-8");
        print json_encode((array)$this->modelPais->getMunicipios($depto));
      }
  }
