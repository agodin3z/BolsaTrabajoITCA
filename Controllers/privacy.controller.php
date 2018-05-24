<?php

  /**
  * The privacy page controller
  */
  class PrivacyController {
      private $model;

      function __construct($model) {
          $this->model = $model;
      }

      public function loadView() {
        $title = "Política de Privacidad";
        require_once 'Views/pages/privacy.php';
      }


  }
