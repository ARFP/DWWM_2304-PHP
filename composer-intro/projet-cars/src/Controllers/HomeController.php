<?php 

namespace App\Controllers;

use App\Car;

use function trim, file_get_contents;

/**
 * Contrôleur par défaut, correspond à la page d'accueil du site
 */
class HomeController 
{
    public function __construct()
    {
        echo 'Vous êtes dans le contrôleur ' . __CLASS__;
    }

    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        echo '<hr>Vous êtes dans la méthode ' . __METHOD__;
    }
}