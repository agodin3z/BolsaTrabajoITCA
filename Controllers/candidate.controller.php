<?php
//Load Mailer
require_once 'mailer.controller.php';

  /**
  * The candidate page controller
  */
  class CandidateController {
      private $model;
      private $modelPais;
      private $modelPerfilPro;
      private $modelIdioma;
      private $modelEstudios;
      private $modelExp;
      private $modelPreferencias;
      private $modelPrograms;
      private $modelSkills;
      private $security;

      function __construct() {
          $this->model = new CandidateModel();
          $this->modelPais = new PaisModel();
          $this->modelPerfilPro = new PerfilProModel();
          $this->modelIdioma = new IdiomaModel();
          $this->modelPrograms = new ConocimientosModel();
          $this->modelSkills = new HabilidadesModel();
          $this->modelEstudios = new EstudiosModel();
          $this->modelExp = new ExperienciasModel();
          $this->modelPreferencias = new PreferenciasModel();
          $this->security = new Security();
          $this->mailer = new MailerController();
      }

      //Cargar Vista de Login
      public function loadView() {
        $title = "Acceso Candidatos";
        require_once 'Views/pages/candidate_log_reg.php';
      }

      //Cargar Vista de Olvidó la contraseña
      public function loadForgotPass() {
        $title = "¿Olvidó la Clave?";
        require_once 'Views/pages/lost-password.php';
      }

      //Cargar Perfil
      public function loadProfile() {
        $candidato = $_SESSION['candidate'];
        $this->renderProfile($candidato,'Perfil',true);
      }

      //Vista cambiar contraseña
      public function loadUpdPasswd() {
        $title = "Cambio de contraseña";
        require_once 'Views/pages/change-password.php';
      }

      //Cargar Perfil de un candidato
      public function showProfile($id) {
        $candidato = new CandidateModel();
        foreach ($this->model->getAll() as $i) {
          if ($id[0] == substr(md5($i->id), 0, 8)) {
            $candidato = $i;
          }
        }
        if (!empty($candidato->id)) {
          $this->renderProfile($candidato,'',false);
        } else {
          $title = "Page Not Found";
          require_once 'Views/pages/404.php';
        }
      }

      //Carga la vista del perfil
      private function renderProfile($candidato,$t,$me) {
        $nombre=explode(" ",$candidato->nombre);
        $apellido=explode(" ",$candidato->apellido);
        $title = $nombre[0]." ".$apellido[0];
        if (!empty($t)) { $title = $t; }
        $idioma = $this->modelIdioma->getIdiomasPer($candidato->id);
        $perfil = $this->modelPerfilPro->getPerfilPro($candidato->id);
        $estudios = $this->modelEstudios->getEstudios($candidato->id);
        $experiencias = $this->modelExp->getExperiencias($candidato->id);
        $preferencias = $this->modelPreferencias->getPreferencias($candidato->id);
        $conocimiento = $this->modelPrograms->getConocimientos($candidato->id);
        $habilidad = $this->modelSkills->getHabilidades($candidato->id);
        require_once 'Views/pages/candidate-profile.php';
      }

      //Cargar Candidatos
      public function loadCandidates() {
        $title = "Candidatos";
        $lista = $this->model->getAll();
        require_once 'Views/pages/candidates.php';
      }

      //Registrar candidato
      public function registerCandidate() {
        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['passwd'])) {
          $this->newCandidate();
        } else {
          //session_start();
          $_SESSION['register_err'] = array(true,"Error al crear la cuenta!");
          header('Location: /candidate/login');
        }
      }

      public function loadSettings() {
        $title = "Editar Perfil";
        $paises = $this->modelPais->getPaises();
        $eCivil = $this->model->getEstadoCivil();
        $idiomas = $this->modelIdioma->getIdiomas();
        $idiomaPer = $this->modelIdioma->getIdiomasPer($_SESSION['candidate']->id);
        $perfil = $this->modelPerfilPro->getPerfilPro($_SESSION['candidate']->id);
        $estudios = $this->modelEstudios->getEstudios($_SESSION['candidate']->id);
        $experiencia = $this->modelExp->getExperiencias($_SESSION['candidate']->id);
        $prefencias = $this->modelPreferencias->getPreferencias($_SESSION['candidate']->id);
        $skills = $this->modelSkills->getHabilidades($_SESSION['candidate']->id);
        $programs = $this->modelPrograms->getConocimientos($_SESSION['candidate']->id);
        require_once 'Views/pages/submit-resume.php';
      }

      // Guardar registro de Candidatos
      private function newCandidate(){
          if (strlen($_POST['passwd']) <= 16) {
            $data=$this->model->check_email(trim($_POST['email']));

        	  if($data > 0)  {
              $_SESSION["register_err"] = array(true, "Error el email ya se encuentra registrado!");
              header("Location: /candidate/login");
            }
        	  else{
              $persona = new CandidateModel();

              $persona->id = $this->genID(trim($_POST['nombre']),trim($_POST['apellido']));
              $persona->email = strtolower(trim($_POST['email']));
              $persona->passwd = $this->security->encryptPasswd($_POST['passwd']);
              $persona->nombre = trim(ucwords($_POST['nombre']));
              $persona->apellido = trim(ucwords($_POST['apellido']));

              $this->model->newPersona($persona);
              $_SESSION['register_err'] = array(false,"El registro fue exitoso!");
        	  }

          } else {
            $_SESSION['register_err'] = array(true,"La contraseña no debe tener más de 16 caracteres!");
          }

          header('Location: /candidate/login');
      }

      // Eliminar Candidatos
      public function delCandidate($id){
          $this->model->delPersona($id);
      }

      //Actualizar candidato
      public function updateCandidate(){
      if (empty(trim($_POST['nombre'])) || empty(trim($_POST['apellido'])) || empty(trim($_POST['email']))) {
          $_SESSION['register_err'] = array(true,"Un campo requerido esta vacío!");
        } else {
          //die(print_r($_POST['habilidad']));
          $user_data=array(
            'nombre'=>ucwords(trim($_POST['nombre'])),
            'apellido'=>ucwords(trim($_POST['apellido'])),
            'email'=>strtolower(trim($_POST['email'])),
            'dui'=>trim($_POST['dui']),
            'fechaNac'=>$_POST['fechaNac'],
            'sexo'=>$_POST['sexo'],
            'tel'=>trim($_POST['tel']),
            'idEstado'=>$_POST['idEstado'],
            'pais'=>$_POST['pais'],
            'depto'=>(isset($_POST['depto']) ? $_POST['depto'] : ''),
            'ciudad'=>(isset($_POST['ciudad']) ? $_POST['ciudad'] : ''),
            'zip'=>trim($_POST['zip']),
            'dir'=>trim($_POST['dir']),
            'id'=>$_SESSION['candidate']->id
      	  );

          //die(print_r($user_data));

          $data=$this->model->updatePersona($user_data); //XXAQUI
          //die(print_r($data));
          $this->updatePerfilPro();
          $this->insertIdioma();
          $this->updateConocimientos();
          $this->updateHabilidades();
          $this->updateEstudios(); //Despues de entender .clone
          $this->updateExperiencias(); //Despues de entender .clone
          $this->updatePreferencias();

          //die(print_r($_FILES['foto']));
          if (isset($_FILES['foto'])) {
            $this->upIMG();
          }
          if (isset($_FILES['curriculum'])) {
            $this->upCV();
          }

      	  if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al actualizar los datos!");
          }
      	  else{
            $_SESSION['register_err'] = array(false,"Actualización de datos exitoso!");
            $dat=$this->model->getPersona($user_data['id']);
            $_SESSION['candidate'] = $dat;
      	  }
        }

          header("Location: /candidate/settings");
      }

      public function updatePerfilPro() {
        $perfilpro = new PerfilProModel();

        $perfilpro->idPersona = $_SESSION['candidate']->id;
        $perfilpro->titulo = ucwords(trim($_POST['titulo']));
        $perfilpro->descripcion = ucfirst(trim($_POST['descripcion']));

        $data=$this->modelPerfilPro->check_PerfilPro($perfilpro->idPersona);

    	  if($data > 0)  {
          //die(print "I");
          $data=$this->modelPerfilPro->newPerfilPro($perfilpro);
        }
    	  else{
          //die(print "A");
          $data=$this->modelPerfilPro->updatePerfilPro($perfilpro);
    	  }
      }

      public function updateConocimientos() {
        $conocimientos = array();

        if (isset($_POST['programa'])) {
          foreach ($_POST['programa'] as $i) {
            array_push($conocimientos, array('programa' => ucfirst(trim($i))));
          }
        }

        $this->modelPrograms->check_Conocimientos($_SESSION['candidate']->id,$conocimientos);
      }

      public function updateHabilidades() {
        $habilidades = array();

        if (isset($_POST['habilidad'])) {
          foreach ($_POST['habilidad'] as $i) {
            array_push($habilidades, array('habilidad' => ucfirst(trim($i))));
          }
        }

        $this->modelSkills->check_Habilidades($_SESSION['candidate']->id,$habilidades);
      }

      public function updateEstudios() {
        $estudio = array();
        //die(print_r($_POST['institucion']));
        if (isset($_POST['institucion']) && isset($_POST['nivel']) && isset($_POST['iniEst']) && isset($_POST['finEst']) && isset($_POST['nota'])) {
          if (count($_POST['institucion']) > 0) {
            for ($i=0; $i < count($_POST['institucion']); $i++) {
              if (!empty(trim($_POST['institucion'][$i])) && !empty(trim($_POST['nivel'][$i])) && !empty(trim($_POST['iniEst'][$i])) && !empty(trim($_POST['finEst'][$i]))) {
                $arreglo = array(
                  'idPersona' => $_SESSION['candidate']->id,
                  'institucion' => ucwords(trim($_POST['institucion'][$i])),
                  'nivel' => ucwords(trim($_POST['nivel'][$i])),
                  'inicio' => $_POST['iniEst'][$i],
                  'fin' => $_POST['finEst'][$i],
                  'notas' => ucfirst(trim($_POST['nota'][$i]))
                );
                array_push($estudio, $arreglo);
              }
            }
            //die(print_r($estudio));

            $this->modelEstudios->check_Estudios($_SESSION['candidate']->id,$estudio);
          }
        }
      }

      public function updateExperiencias() {
        $exp = array();
        //die(print_r($_POST['empresa']));
        if (isset($_POST['empresa']) && isset($_POST['cargo']) && isset($_POST['iniExp']) && isset($_POST['finExp']) && isset($_POST['funciones'])) {
          if (count($_POST['empresa']) > 0) {
            for ($i=0; $i < count($_POST['empresa']); $i++) {
              if (!empty(trim($_POST['empresa'][$i])) && !empty(trim($_POST['cargo'][$i])) && !empty(trim($_POST['iniExp'][$i])) && !empty(trim($_POST['finExp'][$i]))) {
                $arreglo = array(
                  'idPersona' => $_SESSION['candidate']->id,
                  'empresa' => ucwords(trim($_POST['empresa'][$i])),
                  'cargo' => ucwords(trim($_POST['cargo'][$i])),
                  'inicio' => $_POST['iniExp'][$i],
                  'fin' => $_POST['finExp'][$i],
                  'funciones' => ucfirst(trim($_POST['funciones'][$i]))
                );
                array_push($exp, $arreglo);
              }
            }
            $this->modelExp->check_Experiencias($_SESSION['candidate']->id,$exp);
          }
        }
      }

      public function updatePreferencias() {
        $preferencias = new PreferenciasModel();

        $preferencias->idPersona = $_SESSION['candidate']->id;
        $preferencias->situacion = ucwords(trim($_POST['situacion']));
        $preferencias->cargo = ucwords(trim($_POST['puesto']));
        $preferencias->area = ucwords(trim($_POST['area']));
        $preferencias->salarioMin = trim($_POST['salarioMin']);
        $preferencias->depto = ucwords(trim($_POST['deptoP']));

        //die(print_r($preferencias));
        $data=$this->modelPreferencias->check_Preferencias($preferencias->idPersona);

    	  if($data > 0)  {
          //die(print "I");
          $data=$this->modelPreferencias->newPreferencias($preferencias);
        }
    	  else{
          //die(print "A");
          $data=$this->modelPreferencias->updatePreferencias($preferencias);
    	  }
      }

      //Registrar los idiomas
      public function insertIdioma() {
        $idiomas = array();
        //die(print_r($_POST['idioma']));
        if (isset($_POST['idioma'])) {
          foreach ($_POST['idioma'] as $i) {
            $arreglo = array('idIdioma' => $i);
            array_push($idiomas, $arreglo);
          }
        }

        $this->modelIdioma->check_Idioma($_SESSION['candidate']->id,$idiomas);
      }

      //Generar ID basado en el nombre, apellido y la fecha de registro
      private function genID($name,$lastname) {
        $fecha = getdate();
        return strtoupper(substr(trim($name), 0, 1).substr(trim($lastname), 0, 1).$fecha['hours'].$fecha['minutes'].$fecha['seconds']);
      }

      //Hacer login
      public function login_user(){
    	  $user_login=array(
    	  	'email'=>strtolower(trim($_POST['email'])),
    	  	'passwd'=>$this->security->encryptPasswd($_POST['password'])
    	  );

    	  $data=$this->model->check_log($user_login['email'],$user_login['passwd']);

    	  if($data > 0)  {
          $_SESSION["register_err"] = array(true, "Error en el email o contraseña!");
          header("Location: /candidate/login");
        }
    	  else{
          $dat=$this->model->getPersona($this->model->getID($user_login['email'])->id);
          $_SESSION['candidate'] = $dat;
          header("Location: /candidate");
    	  }
    	}

      //Subir Fotografía
      public function upIMG() {
        $permitido = array('jpeg', 'jpg', 'gif', 'png');

        if (isset($_FILES['foto'])) {
            $tmp_name = $_FILES["foto"]["tmp_name"];

            if (is_uploaded_file($tmp_name)) {

                $nombre = $_FILES["foto"]["name"];
                $name = "./assets/images/avatar/".$_SESSION['candidate']->id."_".$nombre;
                $extension=substr(strrchr($name, '.'), 1);
                //die(print_r($name));
                if (in_array($extension, $permitido)) { // Solo admite imagenes
                    if (is_file($name)) { //si existe el archivo
                        $idUnico = time();
                        $name = "./assets/images/avatar/".$_SESSION['candidate']->id."_".$idUnico."-".$nombre;
                    }
                    unlink($_SESSION['candidate']->foto);
                    move_uploaded_file($tmp_name, $name);

                    $this->model->updateFoto(array('id'=>$_SESSION['candidate']->id,'foto'=>$name));
                    //$_SESSION['register_err'] = array(false,"Imagen Subida.");

                } else {
                  $_SESSION['register_err'] = array(true,"El tipo de archivo no es permitido.");
                }

            } else {
              $_SESSION['register_err'] = array(true,"Error al subir la imagen.");
            }
        }
      }

      //Subir CV
      public function upCV() {
        $permitido = array('doc', 'docx', 'pdf');

        if (isset($_FILES['curriculum'])) {
            $tmp_name = $_FILES["curriculum"]["tmp_name"];

            if (is_uploaded_file($tmp_name)) {

                $nombre = $_FILES["curriculum"]["name"];
                $name = "./assets/files/".$_SESSION['candidate']->id."_".$nombre;
                $extension=substr(strrchr($name, '.'), 1);
                //die(print_r($name));
                if (in_array($extension, $permitido)) { // Solo admite imagenes
                    if (is_file($name)) { //si existe el archivo
                        $idUnico = time();
                        $name = "./assets/files/".$idUnico."-".$nombre;
                    }
                    unlink($_SESSION['candidate']->curriculum);
                    move_uploaded_file($tmp_name, $name);

                    $this->model->updateCV(array('id'=>$_SESSION['candidate']->id,'curriculum'=>$name));
                    //$_SESSION['register_err'] = array(false,"Imagen Subida.");

                } else {
                  $_SESSION['register_err'] = array(true,"El tipo de archivo no es permitido.");
                }

            } else {
              $_SESSION['register_err'] = array(true,"Error al subir el CV.");
            }
        }
      }

      //realizar una busqueda filtrada de personas
      public function doSearch() {
        $search = array();
        if (isset($_GET['cat']) && !empty($_GET['cat'])) {
          $search['cargo'] = $_GET['cat'];
        }

        if (isset($_GET['key']) && !empty($_GET['key'])) {
          $search['nombre'] = strtolower(trim($_GET['key']));
          $search['apellido'] = strtolower(trim($_GET['key']));
          $search['situacion'] = strtolower(trim($_GET['key']));
        }

        if (isset($_GET['pais']) && !empty($_GET['pais'])) {
          $search['pais'] = $_GET['pais'];
        }

        if (isset($_GET['depto']) && !empty($_GET['depto'])) {
          $search['depto'] = $_GET['depto'];
        }

        if (count($search) > 0) {
          //die(print_r($this->model->getBusquedaFiltrada($search)));
          $title = "Resultado de búsqueda";
          $lista = $this->model->getBusquedaFiltrada($search);
          //die(print_r(count($lista)));
          require_once 'Views/pages/candidates.php';
        } else {
          header('Location: /candidate/list');
        }
      }

      //Contactar/Contratar Candidatos
      public function hireCandidate($id) {
        //die(print_r($id));
        $email = strtolower(trim($_POST['email']));
        $name = ucwords(trim($_POST['name']));
        $message = trim($_POST['message']);

        $this->mailer->send(
          NOTIFY_EMAIL,  //From
          NOTIFY_NAME,
          $id[1],        //To
          '',
          $email,        //reply
          $name,
          'Te queremos en nuestro equipo!',
          $message,
          ''
        );
        header("Location: /candidate/profile/".$id[0]);
      }

      //Resetear password
      public function resetPasswd() {
        $email  = strtolower(trim($_POST['email']));

        $data=$this->model->check_email(trim($_POST['email']));

        if($data > 0)  {
          $dat=$this->model->getPersona($this->model->getID($email)->id);

          //genPasswd
          $newPasswd = strrev(substr(base64_encode(md5($this->genID(substr($email, 0,3),substr($dat->id, 2,3)))), 0, 10));

          $message = "¡Hola!<br><br>
          Haz solicitado una recuperación de contraseña para esta dirección de correo electrónico: $dat->email <br>
          Si no tiene idea de qué trata este mensaje, ignórelo.<br><br>
          Email: $dat->email <br>
          Nueva contraseña: $newPasswd <br><br>
          Inicie sesión en ITCA Jobs aquí: https://".DOMAIN."/candidate/login <br><br>
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
        header("Location: /candidate/login");
      }


      //Cambiar la contraseña
      public function changePasswd() {
        $old = $_POST['old_passwd'];
        $new = $_POST['new_passwd'];
        //die(print_r($old));
        $data = $this->model->check_log($_SESSION['candidate']->email, $this->security->encryptPasswd($old));

    	  if($data > 0)  {
          $_SESSION["register_err"] = array(true, "Error en la contraseña anterior!");
        }
    	  else{
          $data = $this->model->updatePasswd($_SESSION['candidate']->id, $this->security->encryptPasswd($new));
          if($data > 0)  {
            $_SESSION["register_err"] = array(true, "Error al cambiar la contraseña!");
          }
          else{
            $_SESSION["register_err"] = array(false, "Contraseña cambiada correctamente!");
          }
    	  }
        header("Location: /candidate/change_passwd");
      }
  }
