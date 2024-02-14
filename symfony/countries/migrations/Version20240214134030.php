<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214134030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays CHANGE code_pays code_pays CHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE ville CHANGE code_postal_ville code_postal_ville VARCHAR(8) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays CHANGE code_pays code_pays VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE ville CHANGE code_postal_ville code_postal_ville VARCHAR(5) NOT NULL');
    }
}
