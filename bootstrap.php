<?php
/**
 * The QF Bootstrap File
 *
 */

// Define the app version
define('QF_VERSION', '1.0.0');

// Define the DATABASE version
define('QF_DB_VERSION', '1'); // Increment on every DB change.

// Define required PHP version
define('QF_PHP', '5.6');

// Define installation root path
define('QF_ROOT', dirname(__FILE__));

// Compare PHP versions against our required version
if (!version_compare(PHP_VERSION, QF_PHP, '>=')) {
    exit(
        'QF require PHP '.QF_PHP.' or higher, you currently have PHP '.PHP_VERSION
    );
}

// Set default timezone, we'll base off of this later
date_default_timezone_set('Africa/Lagos');

// Require Autoloader
require_once(QF_ROOT . '/vendor/autoload.php');

// Use our own exception handler
//QF\Core\Exception\QFException::handle();


// Require the configuration file
require_once(QF_ROOT . '/config.php');

if ($config->debug->on) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', $config->debug->logPath);
}

// Get Database configuration details
$db = $config->database;

// Connect to the Database
try {
    QF\Core\Database::instance()->connect("mysql:host=$db->host;dbname=$db->name", $db->user, $db->password);
} catch (QF\Core\Exception\DatabaseException $e) {
    if ($config->debug->on) {
        print_r($e->getMessage());
    }
    $log = new QF\Core\Log($config);
    $log->error($e->getMessage());
}

// All good! create needed objects
$user = new QF\Core\User;
$site = $config->site;
$log  = new QF\Core\Log($config);