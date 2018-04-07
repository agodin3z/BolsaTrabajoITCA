<?php

  /**
  * The 500 page controller
  */
  class InternalErrController {
      private $model;

      function __construct($model) {
          $this->model = $model;
      }

      public function loadView() {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        $title = "Internal Server Error";
        require_once 'Views/pages/500.php';
      }


  }
