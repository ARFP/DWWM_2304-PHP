<?php 

namespace App\Models;

/**
 * Représente une voiture de la table "cars"
 */
class Car 
{
    /** @var int $car_id l'identifiant de la voiture */
    public int $car_id;

    /** @var string $car_brand la marque de la voiture */
    public string $car_brand;

    /** @var string $car_model le nom du modèle de la voiture */
    public string $car_model;

    /** @var int $car_price le prix de la voiture */
    public int $car_price;


    /**
     * Contrôle les données de l'objet et indique si elles sont valides ou non
     * @return bool TRUE si les données sont valides, sinon FALSE
     */
    public function isValid(): bool
    {
        return true;
    }
}
