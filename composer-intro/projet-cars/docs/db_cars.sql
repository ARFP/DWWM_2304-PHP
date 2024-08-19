DROP DATABASE IF EXISTS db_cars;

CREATE DATABASE IF NOT EXISTS db_cars DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE db_cars; 

CREATE TABLE cars 
(
    car_id INT PRIMARY KEY AUTO_INCREMENT,
    car_brand VARCHAR(50) NOT NULL,
    car_model VARCHAR(50) NOT NULL,
    car_price INT NOT NULL
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO cars 
(car_brand, car_model, car_price) 
VALUES 
('Renault', 'Clio III', 21500),
('Renault', 'Captur', 29000),
('Dacia', 'Sandero', 19890),
('Porsche', '718 Cayman', 65850);
