<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240222145740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cpu_production (id INT AUTO_INCREMENT NOT NULL, cpu_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, production_time INT NOT NULL, INDEX IDX_FC3BA921D55914BB (cpu_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cpu_production ADD CONSTRAINT FK_FC3BA921D55914BB FOREIGN KEY (cpu_id_id) REFERENCES cpu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cpu_production DROP FOREIGN KEY FK_FC3BA921D55914BB');
        $this->addSql('DROP TABLE cpu_production');
    }
}
