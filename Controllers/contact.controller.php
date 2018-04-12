<?php
//Load Mailer
require_once 'mailer.controller.php';

  /**
  * The contact us page controller
  */
  class ContactController {
      private $model;
      private $mailer;

      function __construct($model) {
          $this->model = $model;
          $this->mailer = new MailerController();
      }

      public function loadView() {
        $title = "Contáctanos";
        require_once 'Views/pages/contact.php';
      }

      //Enviar mensaje a Webmaster
      public function sendMsg() {
        $email = strtolower(trim($_POST['email']));
        $name = ucwords(trim($_POST['name']));
        $message = trim($_POST['message']);

        $this->mailer->send(
          NOTIFY_EMAIL,  //From
          NOTIFY_NAME,
          WEBMST_EMAIL,  //To
          WEBMST_NAME,
          $email,        //reply
          $name,
          'Mensaje de Contáctanos',
          $message,
          ''
        );
        header("Location: /contact");
      }

  }
