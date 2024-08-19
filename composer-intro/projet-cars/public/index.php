<?php

use App\Router;
use Frederic74200\Db\DbConnect;

// Chargement de l'autoloader de Composer
require (dirname(__DIR__) . '/vendor/autoload.php');

DbConnect::setConfiguration('../src/db_config.php');

// Création du Routeur
$router = new Router();

// Invocation de la méthode run du routeur
$router->run();
