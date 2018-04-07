<?php

  /**
  * The 404 page controller
  */
  class NotFoundController {
      private $model;

      function __construct($model) {
          $this->model = $model;
      }

      public function loadView() {
        header('HTTP/1.1 404 Not Found');
        $title = "Page Not Found";
        require_once 'Views/pages/404.php';
      }


  }
