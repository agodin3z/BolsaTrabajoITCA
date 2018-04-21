<?php

  /**
  * The about page controller
  */
  class AboutController {
      private $model;

      function __construct($model) {
          $this->model = $model;
      }

      public function loadView() {
        $title = "Acerca de";
        require_once 'Views/pages/about.php';
      }


  }
