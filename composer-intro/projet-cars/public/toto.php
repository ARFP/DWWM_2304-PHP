<?php 

// Chargement de l'autoloader de Composer

use App\Dao\DbConnect;

require (dirname(__DIR__) . '/vendor/autoload.php');

$pdo = DbConnect::getInstance();

