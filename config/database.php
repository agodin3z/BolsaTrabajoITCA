<?php

class Database {

  //Conexión a la DB
  public static function conexion() { //StartUp
    try {
      $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e){ //catch (PDOException $e){
      $title = "Internal Server Error";
      require 'Views/pages/500.php';
      exit;
    }

  }
}
