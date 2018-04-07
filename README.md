# Bolsa de Trabajo para ITCA

Proyecto de ciclo del módulo Desarrollo de Aplicaciones Web, creado en PHP

## Requisitos  

Tecnologías/Paquetes necesarios para implementar el proyecto.

* [Apache](https://www.apache.org/) ([XAMPP](https://www.apachefriends.org/es/download.html)/[Ampps](https://www.ampps.com/downloads))
* [MySQL](https://www.mysql.com/downloads/)/[MariaDB](https://mariadb.org/download/)
* [Node.js/NPM](https://nodejs.org/en/)
* [PHP 7.x](https://windows.php.net/download#php-7.0) (Comúnmente viene con XAMPP y Ampps)
* [Composer](https://getcomposer.org/download/) (Para instalar [PHPMailer](https://github.com/PHPMailer/PHPMailer))
* [Bower](https://bower.io/)
* Cuenta en [SendGrid](https://sendgrid.com/pricing/) (Para el envío de correos)

## Estructura del Proyecto  

Para implementar el MVC es imprescindible crear una estructura de ficheros parecida a esta:  

```
./                      #Root
├── .bowerrc            # Configuracion de Bower
├── .git                # Carpeta git
├── .gitignore          # Archivos ignorados por git
├── .htaccess           # Configuracion de Apache
├── assets/             # Archivos de configuracion
│   ├── css/            # Hojas de estilos CSS
│   ├── images/         # Imágenes
│   ├── js/             # Scripts JS
│   └── lib/            # Dependencias Front-End
├── bower.json          # Listado de paquetes para el Front-End
├── composer.json       # Listado de librerias PHP
├── config/             # Archivos de configuracion
│   ├── database.php    # Configuración de la DB
│   └── global.php      # Variables Globales
├── Controllers/        # Controladores
├── index.php           # Controlador frontal
├── Models/             # Modelo de las entidades de la DB
├── package.json        # Info del proyecto
├── README.md           # Archivo Léeme
├── script_db.sql       # DB Backup
├── vendor              # Librerias PHP
└── Views/              # Vistas
    └── pages/          # Páginas HTML
        └── templates/  # Plantillas de vistas

```

## Instalación de las dependencias

### Instalar dependencias Front-End

Una vez instalado `nodejs`, se instala el paquete `bower` y luego con éste se instalan las dependencias del Front-End.
```bash
$ npm i bower --save
$ bower i
```
> **Info:** [¿Cómo instalar NodeJS?](https://nodejs.org/en/download/package-manager/)

### Instalar PHPMailer

Una vez instalado `composer` se procede a instalar `phpmailer`.

```bash
$ composer require phpmailer/phpmailer
```

> **Info:** [¿Cómo instalar composer?](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## Importación de la Base de Datos

Independientemente se tenga `MariaDB` o `MySQL`, ejecutar el siguiente comando en una consola o terminal:

```bash
$ mysql -u root -p db_bolsatrabajo < script_db.sql
```

## Configuración Inicial

Abrir el archivo `config/global.php` y cambiar el valor de las Variables Globales:

```php
//DB Config
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_bolsatrabajo');

//Routes
define('DOMAIN', '');         //Agregar el dominio web
define('BASE_URL', '/');
define('VIEWS_URL', '/Views/');
define('CSS_URL', '/assets/css/');
define('JS_URL', '/assets/js/');
define('IMG_URL', '/assets/images/');
define('LIB_URL', '/assets/lib/');

//PHP Mailer - SMPT Config
define('SMTP_HOST', '');      //Agregar la url del servidor SMTP, ej GMail, SendGrid, etc
define('SMTP_USR', '');       //Agregar el nombre de usuario
define('SMTP_PSW', '');       //Agregar la clave del usuario
define('SMTP_DBG', 0);        //SMTP debugging 0 = off (for production use) 1 = client messages 2 = client and server messages

//PHP Mailer - Notifier Config
define('NOTIFY_EMAIL', '');   //Email con que serán enviados los correos desde la página web
define('NOTIFY_NAME', '');    //Nombre del remitente

//PHP Mailer - Webmaster Config
define('WEBMST_EMAIL', '');   //Email de quien recibirá los correos de la página 'Contáctenos'
define('WEBMST_NAME', '');    //Nombre del receptor

```
