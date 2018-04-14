<?php

  /**
  * The candidate page view
  */
  class CandidateView {

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
        if (isset($_SESSION['candidate'])) {
          return $this->controller->loadProfile();
        } else {
          header("Location: /candidate/login");
        }
      }

      public function lost_password() {
          return $this->controller->loadForgotPass();
      }

      public function list() {
          return $this->controller->loadCandidates();
      }

      public function settings() {
          return $this->controller->loadSettings();
      }

      public function register() {
          $this->controller->registerCandidate();
      }

      public function login_user() {
        $this->controller->login_user();
      }

      public function update_user() {
        $this->controller->updateCandidate();
      }

      public function profile($id) {
        $this->controller->showProfile($id);
      }

      public function search() {
        $this->controller->doSearch();
      }

      public function delete($id) {
        $this->controller->delCandidate($id);
      }

      public function hire($id) {
        $this->controller->hireCandidate($id);
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
