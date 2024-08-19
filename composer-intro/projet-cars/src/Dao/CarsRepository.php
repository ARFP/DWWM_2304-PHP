<?php 

namespace App\Dao;

use PDO;
use App\Models\Car;
use Frederic74200\Db\DbConnect;

/**
 * Contient les requêtes vers la base de données pour la table "cars"
 */
class CarsRepository 
{
    /** @var PDO $db l'instance de PDO utilisée pour l'interaction avec la base de données */
    private PDO $db;


    public function __construct()
    {
        $this->db = DbConnect::getInstance();
    }

    /**
     * Récupère toutes les lignes de la table 
     * @return array le jeu de résultat
     */
    public function selectAll(): array 
    {
        /** @var string $rq la requête à exécuter */
        $rq = "SELECT car_id, car_brand, car_model, car_price FROM cars;";

        /** @var \PDOStatement $stmt */
        $stmt = $this->db->query($rq);

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'App\\Models\\Car');

        return $result;
    }

    /**
     * Récupère 1 élément de la table identifié par $car_id
     * @param int $car_id l'identifiant de l'élément à récupérer
     * @return Car l'élément trouvé ou null si aucune correspondance
     */
    public function selectOne(int $car_id): ?Car 
    {
        /** @var string $rq la requête à exécuter */
        $rq = "SELECT car_id, car_brand, car_model, car_price FROM cars WHERE car_id=:car_id;";

        $stmt = $this->db->prepare($rq);

        //$stmt->bindValue(':car_id', $car_id, PDO::PARAM_INT);

        $values = [':car_id' => $car_id];

        $result = null;

        if($stmt->execute($values)) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\\Models\\Car');
            $result = $stmt->fetch();
        }

        return $result !== false ? $result : null;
    }

    /**
     * Ajoute un nouvel élément dans la table
     * @param Car $new_car les données du nouvel élément à ajouter
     * @return bool TRUE si l'ajout a réussi, sinon FALSE
     */
    public function insert(Car $new_car): bool
    {
        $rq = "INSERT INTO cars 
                (car_brand, car_model, car_price)
                VALUES
                (:car_brand, :car_model, :car_price)";

        $stmt = $this->db->prepare($rq);

        $values= [
            ':car_brand' => $new_car->car_brand,
            ':car_model' => $new_car->car_model,
            ':car_price' => $new_car->car_price
        ];

        if($stmt->execute($values)) {
            $lignes = $stmt->rowCount();

            return $lignes === 1;
        }

        return false;
    }

    /**
     * Met à jour un élément existant dans la table
     * @param Car $car_to_update les données de l'élément à modifier
     * @return bool TRUE si la modification a réussi, sinon FALSE
     */
    public function update(Car $car_to_update): bool
    {
        return false;
    }

    /**
     * Supprime un élément de la table identifié par $car_id
     * @param int $car_id l'identifiant de l'élément à supprimer
     * @return bool TRUE si la suppression a réussi, sinon FALSE
     */
    public function delete(int $car_id): bool
    {
        return false;
    }

    public function lastInsertId() 
    {
        return $this->db->lastInsertId();
    }
}
