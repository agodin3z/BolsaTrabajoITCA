<?php

  /**
  * The contact us page view
  */
  class ContactView {

      private $model;

      private $controller;


      function __construct($controller, $model) {
          $this->controller = $controller;

          $this->model = $model;
      }

      public function index() {
          return $this->controller->loadView();
      }

      public function sendMail() {
          return $this->controller->sendMsg();
      }

  }
