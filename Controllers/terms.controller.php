<?php

  /**
  * The terms page controller
  */
  class TermsController {
      private $model;

      function __construct($model) {
          $this->model = $model;
      }

      public function loadView() {
        $title = "Términos y Condiciones de Uso";
        require_once 'Views/pages/terms.php';
      }


  }
