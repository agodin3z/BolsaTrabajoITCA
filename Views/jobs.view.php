<?php

  /**
  * The jobs page view
  */
  class JobsView {

    private $model;

    private $controller;


    function __construct($controller, $model) {
        $this->controller = $controller;

        $this->model = $model;
    }


    public function index() {
        return $this->controller->loadJobs();
    }

    public function create() {
        return $this->controller->loadView();
    }

    public function register() {
        $this->controller->registerJob();
    }

    public function update() {
      $this->controller->updJob();
    }

    public function offert($id) {
      $this->controller->showOffert($id);
    }

    public function edit($id) {
      $this->controller->loadEdit($id);
    }

    public function search() {
      $this->controller->doSearch();
    }

    public function company($id) {
      $this->controller->getJobsCompany($id);
    }

    public function delete($id) {
      $this->controller->delJob($id);
    }

    public function apply($id) {
      $this->controller->applyJob($id);
    }

  }
