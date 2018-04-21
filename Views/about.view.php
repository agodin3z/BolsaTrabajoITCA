<?php

  /**
  * The about page view
  */
  class AboutView {

      private $model;

      private $controller;


      function __construct($controller, $model) {
          $this->controller = $controller;

          $this->model = $model;
      }

      public function index() {
          return $this->controller->loadView();
      }

  }
