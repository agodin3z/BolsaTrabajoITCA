<?php

  /**
  * The company page view
  */
  class CompanyView {

    private $model;

    private $controller;


    function __construct($controller, $model) {
        $this->controller = $controller;

        $this->model = $model;
    }

    public function login() {
        return $this->controller->loadView();
    }

    public function index() {
      if (isset($_SESSION['company'])) {
        return $this->controller->loadProfile();
      } else {
        header("Location: /company/list");
      }
    }

    public function lost_password() {
        return $this->controller->loadForgotPass();
    }

    public function list() {
        return $this->controller->loadCompanies();
    }

    public function settings() {
        return $this->controller->loadSettings();
    }

    public function register() {
        $this->controller->registerCompany();
    }

    public function login_user() {
      $this->controller->login_user();
    }

    public function update_user() {
      $this->controller->updCompany();
    }

    public function profile($id) {
      $this->controller->showProfile($id);
    }

    public function search() {
      $this->controller->doSearch();
    }

    public function deptos($id) {
      $this->controller->getDeptos($id);
    }
    public function municp($id) {
      $this->controller->getMunicp($id);
    }

    public function delete($id) {
      $this->controller->delCompany($id);
    }

    public function reset() {
      $this->controller->resetPasswd();
    }

    public function change_passwd() {
      $this->controller->loadUpdPasswd();
    }

    public function update_passwd() {
      $this->controller->changePasswd();
    }

    public function logout() {
      session_destroy();
      header("Location: /");
    }

  }
