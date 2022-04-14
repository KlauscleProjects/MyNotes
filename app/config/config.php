<?php

/**
 * DB Params
 */
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);

//App Root
define('APPROOT', dirname(__FILE__, 2));

//URL Root
define('URLROOT', $_ENV['URL_ROOT']);

//Site Name
define('SITENAME', $_ENV['SITE_NAME']);

//App Version
define('APPVERSION', $_ENV['APP_VERSION']);

//SMTP (PHPMailer)
define("MAILER_HOST", $_ENV['MAILER_HOST']);
define('MAILER_EMAIL', $_ENV['MAILER_USERNAME']);
define("MAILER_NAME", $_ENV['MAILER_NAME']);
define('MAILER_PASSWORD', $_ENV['MAILER_PASSWORD']);
define('MAILER_SMTPSECURE', $_ENV['MAILER_SMTP_SECURE']);
define('MAILER_PORT', $_ENV['MAILER_PORT']);
