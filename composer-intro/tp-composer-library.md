# Composer : Créer une bibliothèque réutilisable.

Dans ces travaux pratiques, vous allez mettre en place 1 dépôt github contenant des bibliothèques de classes que vous pourrez réutiliser dans vos projets.

> Dans les consignes ci-dessous, remplacez "nomDutilisateurGithub" par votre nom d'utilisateur github.

## Travail à réaliser

1. Créer un dépôt nommé "php-library" sur [github.com](https://github.com)
    - initialiser le dépôt avec un **README.md** et le .gitignore **VisualStudio**
2. Dans ce dépôt, créer une branche de travail **develop**
3. Cloner ce dépôt sur votre machine locale
4. Positionnez vous sur la branche **develop**
5. à la racine du dépôt, initialiser un nouveau projet composer
    - nom: **nomDutilisateurGithub/php-library**
    - type: **library**
6. Créer un répertoire **Db** et y ajouter une classe **Dbconnect** 

```php
<?php 

namespace nomDutilisateurGithub\Db;

use PDO; 

/**
 * Connexion à la base de données (SINGLETON)
 */
class DbConnect
{
    /**
     * Constructeur privé (la classe n'est pas instanciable)
     */
    private function __construct() {}

    /** @var PDO $instance l'instance PDO unique */
    private static ?PDO $instance = null;

    /**
     * Récupère l'instance unique de PDO
     * La crée si elle n'existe pas encore
     * @return PDO l'instance de PDO
     */
    public static function getInstance(): PDO
    {
        if(self::$instance === null) {
            self::$instance = new PDO('mysql:host=localhost;port=3306;dbname=db_cars;charset=utf8', 'root', '', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
}

```

Valider et Pousser ce travail sur github.


## Questions à résoudre

Vous souhaitez pouvoir réutiliser cette classe en lui fournissant un fichier de configuration pour déterminer l'hôte, le port, le nom de la base de données, le nom d'utilisateur et le mot de passe.

Le fichier de configuration sera un fichier **php** dont le contenu ressemblera au code ci-dessous : 

```php
<?php 

return [
    'db_host' => 'localhost',
    'db_port' => '3306',
    'db_name' => 'un_nom_de_base_de_donnees',
    'db_user' => 'root',
    'db_password' => '',
];

```

Dans la classe Dbconnect, implémentez une méthode statique :
```php 
public function setConfiguration(string $chemin_vers_le_fichier);
```

Cette méthode prend en paramètre un chemin vers un fichier de configuration et les informations qu'il contient sont stockés dans un attribut statique `private static array $config`.


Une fois terminé, valider et pousser sur github.

Pour tester votre code, vous pouvez implémenter un script qui pourrait ressembler à celui-ci-dessous : 

```php
<?php 

use nomDutilisateurGithub\Db\DbConnect;

require '../vendor/autoload.php';

DbConnect::setConfiguration('./chemin/vers/config.php');

$pdo = DbConnect::getInstance();

var_dump($pdo); 

```