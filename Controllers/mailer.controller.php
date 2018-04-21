<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

  /**
  * The PHP Mailer controller
  */
  class MailerController {

    //Send Any Message
    public function send($from, $fromName, $to, $toName, $reply, $replyName, $subject, $message, $file) {
      $mail = new PHPMailer(true);
      $mail->CharSet = 'UTF-8';
      try {
          //Server settings
          $mail->SMTPDebug = SMTP_DBG;
          $mail->isSMTP();
          $mail->Host = SMTP_HOST;
          $mail->SMTPAuth = true;
          $mail->Username = SMTP_USR;
          $mail->Password = SMTP_PSW;
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          //Recipients
          $mail->setFrom($from, $fromName);
          if (!empty($toName)) {
            $mail->addAddress($to, $toName);
          } else {
            $mail->addAddress($to);
          }
          $mail->addReplyTo($reply, $replyName);

          //Attachments
          if (!empty($file)) {
            $mail->addAttachment($file, 'CurriculumVitae');
          }

          //Content
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = wordwrap($message, 70, "\r\n");
          $mail->AltBody = wordwrap($message, 70, "\r\n"); //for non-HTML mail clients

          $mail->send();
          //echo 'Message has been sent';
          $_SESSION['register_err'] = array(false,"Mensaje enviado!");
      } catch (Exception $e) {
          //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
          $_SESSION['register_err'] = array(true,"Mensaje no enviado!");
      }
    }

  }
