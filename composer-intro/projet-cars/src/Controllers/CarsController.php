<?php 

namespace App\Controllers;

use App\Dao\CarsRepository;
use App\Models\Car;

use function trim, file_get_contents;

/**
 * Contrôleur pour la gestion du modèle 'Car'
 */
class CarsController implements ControllerInterface
{
    // private Car $car;
    private CarsRepository $repo;

    public function __construct()
    {
        $this->repo = new CarsRepository();
    }

    /**
     * Affiche le contenu de la table
     */
    public function index(): void
    {
        $result = $this->repo->selectAll();

       //echo '<pre>' . var_export($result, true) . '</pre>';

       echo json_encode($result, JSON_PRETTY_PRINT);
    }

     /**
     * Affiche les informations d'un élément de la table
     */
    public function details($car_id): void
    {
        $car_id = intval($car_id);

        $result = $this->repo->selectOne($car_id);

        echo json_encode($result);
    }

    /**
     * Ajoute un nouvel élément dans la table
     */
    public function insert(): void
    {
        
        $car = new Car();
        $car->car_brand = $_POST['car_brand'];
        $car->car_model = $_POST['car_model'];
        $car->car_price = $_POST['car_price'];

        if($car->isValid()) {
            $result = $this->repo->insert($car);
        }

        if($result === true) {
            $new_id = $this->repo->lastInsertId();
            echo  $this->details($new_id);
        }

        
    }

     /**
     * Modifie un élément existant en base de données
     */
    public function update($id): void
    {

    }

     /**
     * Supprime un élément existant en base de données
     */
    public function delete($id): void
    {

    }
}