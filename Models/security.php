<?php

  /**
  * The Encrypt/Decrypt Password Functions
  */

  class Security {
    private $cryptKey;
    private $cifrado;

    function __construct() {
      $this->cryptKey = 'qJB0rGtIn5UB1xG03efyCp'; //Secret Key
      $this->cifrado = "AES-128-CBC"; //Tipo de Clave de Cifrado
    }

    //Encriptamiento de la contraseña
    public function encryptPasswd($passwd) {
      $ivlen = openssl_cipher_iv_length($this->cifrado); //Longitud de la clave
      $iv = openssl_random_pseudo_bytes($ivlen); //Genera una cadena de bytes pseudo-aleatoria
      $cifrado_raw = openssl_encrypt($passwd, $this->cifrado, $this->cryptKey, $options=OPENSSL_RAW_DATA, $iv); //Encripta datos
      $hmac = hash_hmac('sha256', $cifrado_raw, $this->cryptKey, $as_binary=true); //Valor cifrado mediante el método HMAC
      $encrypted = base64_encode($iv.$hmac.$cifrado_raw); //Encripta la contraseña junto los demas valores
      return $encrypted; //Retorna la contraseña encriptada
    }

    //Desencriptamiento de la contraseña
    public function decryptPasswd($passwd) {
      $cadena = base64_decode($passwd); //Decodifica la clave encriptada
      $ivlen = openssl_cipher_iv_length($this->cifrado);//Longitud de la clave
      $iv = substr($cadena, 0, $ivlen); //Obtine la cadena de bytes pseudo-aleatoria
      $hmac = substr($cadena, $ivlen, $sha2len=32); //Obtiene el valor cifrado mediante el método HMAC
      $cifrado_raw = substr($cadena, $ivlen+$sha2len); //Obtiene el dato encriptado
      $decrypted = openssl_decrypt($cifrado_raw, $this->cifrado, $this->cryptKey, $options=OPENSSL_RAW_DATA, $iv); //Hace el desencriptamiento
      $calcmac = hash_hmac('sha256', $cifrado_raw, $this->cryptKey, $as_binary=true); // Genera el valor cifrado mediante el método HMAC
      if (hash_equals($hmac, $calcmac)){ //Compara si los 2 valores son iguales
          return $decrypted; //Retorna la contraseña desencriptada
      }
    }
  }
