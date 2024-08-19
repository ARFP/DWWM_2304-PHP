# API-EXAMPLE 

Cette api expose :

- Des voitures `Car (car_brand, car_model, car_price)`.
- Les immatriculations `CarRegister (car_registration, car_date)`.
- Les accessoires installés dans chaque modèle de voiture `CarAccessory (accessory_name, accessory_price)`.

Relation entre les entités : 

**Car <-> CarRegister**
- **1** immatriculation concerne **1** seul modèle de voiture
- **1** modèle de voiture concerne **0 ou plusieurs** immatriculations

**Car <-> CarAccessories**
- **1** modèle de voiture contient **0 ou plusieurs** accessoires
- **1** accessoire est contenu dans **0 ou plusieurs** voitures