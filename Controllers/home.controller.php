<?php

  /**
  * The home page controller
  */
  class HomeController {
      private $model;
      private $modelReview;
      private $modelJob;
      private $modelCorp;

      function __construct($model) {
          $this->model = $model;
          $this->modelReview = new ReviewModel();
          $this->modelJob = new JobsModel();
          $this->modelCorp = new CompanyModel();
      }

      public function loadView() {
        $title = "Home";
        //Random Reviews
        $reviews = $this->makeRandomArray($this->modelReview->getAll(), 4);
        //Random Ofertas
        $ofertas = $this->makeRandomArray($this->modelJob->getAll(), 4);
        //Total de ofertas
        $total = $this->modelJob->countOfertas();
        //Random Empresas
        $empresas = $this->makeRandomArray($this->modelCorp->getAll(), 5);
        //die(print_r($ofertas));
        require_once 'Views/pages/home.php';
      }

      /*
      *   Crear arreglo con valores aleatorio de la db
      *   $array = arreglo de valores
      *   $num = cantidad de valores que se desean
      */
      private function makeRandomArray($array,$num) {
        $aux = array();

        if (count($array) > 1) {
          $cant = array_rand($array, (count($array) >= $num) ? $num : count($array));
          //die(print_r($cant));
          for ($i=0; $i < count($cant); $i++) {
            //die(print_r(array($array[$cant[$i]])));
            array_push($aux, $array[$cant[$i]]);
          }
          $array = $aux;
        }

        return $array;
      }
  }
