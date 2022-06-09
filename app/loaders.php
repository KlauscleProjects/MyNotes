<?php
require_once realpath(dirname(__DIR__, 1) . "/vendor/autoload.php");

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();

// load config
require_once 'config/config.php';

//load helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

//PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//autoload core libraries
spl_autoload_register(function ($className) {
   require_once "libraries/$className.php";
});
