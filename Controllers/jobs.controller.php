<?php
//Load Mailer
require_once 'mailer.controller.php';

  /**
  * The Ofertas page controller
  */
  class JobsController {
      private $model;
      private $modelJornada;
      private $modelContrato;
      private $modelCat;

      function __construct() {
          $this->model = new JobsModel();
          $this->modelJornada = new JornadaModel();
          $this->modelContrato = new ContratoModel();
          $this->modelCat = new CategoriaModel();
          $this->mailer = new MailerController();
      }

      //Cargar Ofertas
      public function loadJobs() {
        $title = "Ofertas";
        $lista = $this->model->getAll();
        require_once 'Views/pages/jobs.php';
      }

      //Crear Ofertas
      public function loadView() {
        $title = "Publicar una Oferta";
        //$lista = $this->model->getAll();
        $tipo = $this->modelContrato->getAll();
        $jornada = $this->modelJornada->getAll();
        $categoria = $this->modelCat->getAll();
        require_once 'Views/pages/submit-job.php';
      }

      //Registrar Oferta
      public function registerJob() {
        if (!isset($_POST['id'])) {
          if (isset($_POST['titulo']) && isset($_POST['descripcion'])) {
            $this->newJob();
          } else {
            //session_start();
            $_SESSION['register_err'] = array(true,"Error al crear la Oferta de Trabajo!");
          }
          header('Location: /jobs/create');
        } else {
          if (isset($_POST['titulo']) && isset($_POST['descripcion'])) {
            $this->updJob();
          } else {
            //session_start();
            $_SESSION['register_err'] = array(true,"Error al actualizar la Oferta de Trabajo!");
          }
          header('Location: /jobs/edit/'.substr(md5($_POST['id']), 0, 8));
        }
      }

      //Cargar detalles de oferta específica
      public function showOffert($id) {
        $oferta = new JobsModel();
        foreach ($this->model->getAll() as $i) {
          if ($id[0] == substr(md5($i->id), 0, 8)) {
            $oferta = $i;
          }
        }
        if (!empty($oferta->id)) {
          $related = $this->model->getRelated($oferta->id,$oferta->categoria);
          $title = substr($oferta->titulo, 0, 32)."...";

          if (isset($_SESSION['candidate'])) {
            $mensaje = "Hola $oferta->empresa!<br><br>
            Soy ".$_SESSION['candidate']->nombre." ".$_SESSION['candidate']->apellido.". <br>
            Me gustaría aspirar a cargo de $oferta->cargo de la oferta: http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']." , adjunto mi curriculum. <br><br>
            Saludos cordiales!";
          }

          require_once 'Views/pages/job-profile.php';
        } else {
          $title = "Page Not Found";
          require_once 'Views/pages/404.php';
        }
      }

      // Cargar formulario para editar oferta
      public function loadEdit($id) {
        $tipo = $this->modelContrato->getAll();
        $jornada = $this->modelJornada->getAll();
        $categoria = $this->modelCat->getAll();
        $oferta = new JobsModel();
        foreach ($this->model->getAll() as $i) {
          if ($id[0] == substr(md5($i->id), 0, 8)) {
            $oferta = $i;
          }
        }
        if (!empty($oferta->id)) {
          $title = "Editar ".substr($oferta->titulo, 0, 16)."...";
          require_once 'Views/pages/submit-job.php';
        } else {
          $title = "Page Not Found";
          require_once 'Views/pages/404.php';
        }
      }

      // Guardar Oferta
      private function newJob(){
        //die(print_r($_POST['residencia']));
        $oferta = new JobsModel();

        $oferta->id = $this->genID(trim($_POST['titulo']));
        $oferta->idEmpresa = $_SESSION['company']->id;
        $oferta->titulo = ucwords(trim($_POST['titulo']));
        $oferta->area = ucwords(trim($_POST['area']));
        $oferta->cargo = ucwords(trim($_POST['cargo']));
        $oferta->contrato = $_POST['contrato'];
        $oferta->jornada = $_POST['jornada'];
        $oferta->categoria = $_POST['categoria'];
        $oferta->email = strtolower(trim($_POST['email']));
        $oferta->salario = ucwords(trim($_POST['salario']));
        $oferta->localizacion = ucwords(trim($_POST['localizacion']));
        $oferta->descripcion = ucfirst(trim($_POST['descripcion']));
        $oferta->vacantes = $_POST['vacantes'];
        $oferta->educacionMin = ucfirst(trim($_POST['educacionMin']));
        $oferta->edad = ucwords(trim($_POST['edad']));
        $oferta->viajar = $_POST['viajar'];
        $oferta->residencia = $_POST['residencia'];
        $oferta->imagen = $_SESSION['company']->logo;
        $oferta->fechaPub = date("Y-m-d");

        //die(print_r($oferta));
        $this->model->newOferta($oferta);

        $_SESSION['register_err'] = array(false,"El registro fue exitoso!");
      }

      // Eliminar oferta
      public function delJob($id){
          //die(print_r($id));
          $this->model->delOferta($id);
      }

      //Actualizar oferta
      public function updJob(){
      if (empty(trim($_POST['titulo'])) || empty(trim($_POST['descripcion']))) {
          $_SESSION['register_err'] = array(true,"Un campo requerido esta vacío!");
        } else {
          //die(print_r($_POST['id']));
          $oferta = array(
            'titulo'=>ucwords(trim($_POST['titulo'])),
            'area'=>ucwords(trim($_POST['area'])),
            'cargo'=>ucwords(trim($_POST['cargo'])),
            'contrato'=>$_POST['contrato'],
            'jornada'=>$_POST['jornada'],
            'categoria'=>$_POST['categoria'],
            'email'=>strtolower(trim($_POST['email'])),
            'salario'=>ucwords(trim($_POST['salario'])),
            'localizacion'=>ucwords(trim($_POST['localizacion'])),
            'descripcion'=>ucfirst(trim($_POST['descripcion'])),
            'vacantes'=>$_POST['vacantes'],
            'educacionMin'=>ucfirst(trim($_POST['educacionMin'])),
            'edad'=>ucwords(trim($_POST['edad'])),
            'viajar'=>$_POST['viajar'],
            'residencia'=>$_POST['residencia'],
            'id'=>$_POST['id']
      	  );

          //die(print_r($oferta));

          $data = $this->model->updOferta($oferta);

      	  if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al actualizar los datos!");
          }
      	  else{
            $_SESSION['register_err'] = array(false,"Actualización de datos exitoso!");
            $oferta = $this->model->getOferta($oferta['id']);
      	  }
        }
      }

      //Generar ID basado en el titulo y la fecha de registro
      private function genID($name) {
        $fecha = getdate();
        return strtoupper(substr(trim($_SESSION['company']->id), 0, 3).substr(trim($name), 0, 3).$fecha['hours'].$fecha['minutes'].$fecha['seconds']);
      }

      //realizar una busqueda filtrada de Ofertas
      public function doSearch() {
        $search = array();
        if (isset($_GET['cat']) && !empty($_GET['cat'])) {
          $search['categoria'] = $_GET['cat'];
        }

        if (isset($_GET['key']) && !empty($_GET['key'])) {
          $search['titulo'] = $_GET['key'];
          $search['descripcion'] = $_GET['key'];
        }

        if (isset($_GET['loc']) && !empty($_GET['loc'])) {
          $search['localizacion'] = $_GET['loc'];
        }

        if (count($search) > 0) {
          //die(print_r($this->model->getOfertasFiltrada($search)));
          $title = "Resultado de búsqueda";
          $lista = $this->model->getOfertasFiltrada($search);
          //die(print_r(count($lista)));
          require_once 'Views/pages/jobs.php';
        } else {
          header('Location: /jobs');
        }
      }

      //Obtener ofertas por idEmpresa
      public function getJobsCompany($empresa) {
        $oferta = new JobsModel();
        foreach ($this->model->getAll() as $i) {
          if ($empresa[0] == substr(md5($i->idEmpresa), 0, 8)) {
            $oferta = $i;
          }
        }
        //die(print_r($oferta->empresa));
        if (!empty($oferta->idEmpresa)) {
          $empresa = $oferta->empresa;
          $title = "Ofertas Laborales de ". $empresa;
          $lista = $this->model->getOfertasEmpresa($oferta->idEmpresa);
          $altCV = $_POST['alt_cv'];
          //die(print_r(count($lista)));
          require_once 'Views/pages/jobs.php';
        }
      }

      //Aplicar a oferta laboral
      public function applyJob($id) {
        //die(print_r($_FILES['cv']));
        $email = strtolower(trim($_POST['email']));
        $name = ucwords(trim($_POST['name']));
        $message = trim($_POST['message']);

        //Subir Archivo Temporal
        if (array_key_exists('cv', $_FILES) && !empty($_FILES['cv']['name'])) {
          $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['cv']['name']));
          if (in_array(substr(strrchr($_FILES['cv']['name'], '.'), 1), array('doc', 'docx', 'pdf', 'odt'))) {
            //die(print_r('yes'));
            if (move_uploaded_file($_FILES['cv']['tmp_name'], $uploadfile)) {
                //die(print_r($uploadfile));
                $this->send($id[1],$email,$name,$message,$uploadfile);
            } else {
                die(print_r('nope'));
                $_SESSION['register_err'] = array(true,"Error al subir el CV.");
            }
          } else {
            $_SESSION['register_err'] = array(true,"Tipo de archivo no permitido!");
          }
        } else {
          //die(print_r($_SESSION['candidate']->curriculum));
          $this->send($id[1],$email,$name,$message,$_SESSION['candidate']->curriculum);
        }
        header("Location: /jobs/offert/".$id[0]);
      }

      private function send($to, $email,$name,$message,$file) {
        $this->mailer->send(
          NOTIFY_EMAIL,  //From
          NOTIFY_NAME,
          $to,           //To
          '',
          $email,        //reply
          $name,
          'Quiero aplicar a la oferta!',
          $message,
          $file
        );
      }
  }
