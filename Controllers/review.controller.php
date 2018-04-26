<?php

  /**
  * The company page controller
  */
  class ReviewController {
      private $model;

      function __construct() {
          $this->model = new ReviewModel();
      }

      //Cargar Reviews
      public function loadReviews() {
        $title = "Testimonios";
        $lista = $this->model->getAll();
        require_once 'Views/pages/reviews.php';
      }


      //Cargar Perfil
      public function loadAddReview() {
        $title = "Agregar Testimonio";
        $review = $this->model->getTestimonio($_SESSION['company']->id);
        require_once 'Views/pages/submit-review.php';
      }


      //Registrar testimonio
      public function registerReview() {
        if (isset($_POST['testimonio'])) {
          $review = new ReviewModel();
          $review->idEmpresa = $_SESSION['company']->id;
          $review->testimonio = $_POST['testimonio'];
          $review->rating = $_POST['rating'];
          $review->fecha = date("Y-m-d");
          //die(print_r($review));

          $data = $this->model->checkTestimonio($_SESSION['company']->id);
          //die(print_r($data));
          if ($data > 0) {

            if (empty($_POST['testimonio'])) {
              //die(print "d");
              $this->model->delTestimonio($_SESSION['company']->id);
              $_SESSION['register_err'] = array(false,"Eliminación exitosa!");
            } else {
              //die(print "a");
              $this->model->updTestimonio($review);
              $_SESSION['register_err'] = array(false,"Actualización exitosa!");
            }
          } else {
            if (empty($_POST['testimonio'])) {
              $_SESSION['register_err'] = array(true,"Opps, no hay nada que registrar!");
            } else {
              //die(print "i");
              $this->model->newTestimonio($review);
              $_SESSION['register_err'] = array(false,"El registro fue exitoso!");
            }
          }

        } else {
          //session_start();
          $_SESSION['register_err'] = array(true,"Error al registrar el testimonio!");
        }
        header('Location: ../review/admin');
      }

      // Eliminar Testimonio
      private function delReview(){
          $this->model->delTestimonio($_SESSION['company']->id);
          header('Location: ../review/admin');
      }

  }
