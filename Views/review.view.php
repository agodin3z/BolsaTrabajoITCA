<?php

  /**
  * The testimonios page view
  */
  class ReviewView {

    private $model;

    private $controller;


    function __construct($controller, $model) {
        $this->controller = $controller;

        $this->model = $model;
    }

    public function index() {
        return $this->controller->loadReviews();
    }

    public function admin() {
        return $this->controller->loadAddReview();
    }

    public function register() {
        $this->controller->registerReview();
    }

    public function delete() {
        $this->controller->delReview();
    }

  }
