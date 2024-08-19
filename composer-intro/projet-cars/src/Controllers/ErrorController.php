<?php 

namespace App\Controllers;

use App\Car;

use function trim, file_get_contents;

/**
 * Affiche une page d'erreur
 */
class ErrorController 
{
    public function __construct()
    {
        echo __CLASS__;
    }

    /**
     * Affiche la page d'erreur
     */
    public function index()
    {

    }
}