<?php 

namespace App;

use App\Controllers\CarsController;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;

use function mb_convert_case;

/**
 * Analyse la requête afin d'identifier le contrôleur à instancier
 */
class Router
{
    /** @var array $route La route récupérée à partir de l'url */
    private ?array $route;

    /** @var string $controller Le nom du contrôleur identifié */
    private string $controller;

    /** @var string $action le nom de la méthode à invoquer dans le contrôleur */
    private string $action;

    /** @var string $id le paramètre à transmettre à la méthode du contrôleur */
    private ?string $id;

    /**
     * Constructeur
     * 1. Lit la chaine de requête (QUERY_STRING) à partir de l'url 
     * 2. Décompose la chaine sous forme de tableau
     * 3. Identifie le contrôleur, l'action et l'id (cf commentaires des attributs ci-dessus)
     */
    public function __construct()
    {
        // echo $_SERVER['QUERY_STRING'] ?? '' . '<hr>';
        
        // Récupère la chaine de requête ou une chaine vide si aucune valeur trouvée
        $query_string = $_SERVER['QUERY_STRING'] ?? '';

        // transforme la chaine de requête en tableau et stocke le résultat dans l'attribut $this->route
        // controller=home&action=index&id=2
        // devient
        // ['controller' => 'home', 'action' => 'index', 'id' => 2]
        parse_str($query_string, $this->route);

        $this->controller = mb_convert_case($this->route['controller'] ?? 'home', MB_CASE_LOWER);
        $this->action = mb_convert_case($this->route['action'] ?? 'index', MB_CASE_LOWER);
        $this->id = $this->route['id'] ?? null;
    }

    /**
     * Instancie le contrôleur et exécute l'action
     * @return never l'application doit stopper à la fin de la méthode (via l'instruction 'exit', par exemple)
     */
    public function run() : never
    {
        $c = null; // on stockera l'instance du contrôleur dans cette variable

        switch($this->controller)
        {
            case 'home':
                $c = new HomeController();
            break;
            case 'cars':
                $c = new CarsController();
            break;
            default: 
                $c = new ErrorController();
            break;
        }

        $action = $this->action; // 'index' ou 'update'

        if(method_exists($c, $action)) {
            $c->{$action}($this->id);
        } else {
            exit('La méthode n\'existe pas');
        }

        exit;
    }
}