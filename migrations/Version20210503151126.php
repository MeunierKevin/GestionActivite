<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503151126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, analyse_existant LONGTEXT NOT NULL, objectifs_du_site LONGTEXT NOT NULL, cibles VARCHAR(255) NOT NULL, fonctionnalites LONGTEXT NOT NULL, charte_graphique VARCHAR(255) NOT NULL, contenu_du_site LONGTEXT NOT NULL, maquettage LONGTEXT NOT NULL, contraintes_techniques LONGTEXT NOT NULL, prestations_devis LONGTEXT NOT NULL, date_maquette DATETIME NOT NULL, date_developpement DATETIME NOT NULL, date_tests DATETIME NOT NULL, date_mise_en_ligne DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD presentation_entreprise LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projet');
        $this->addSql('ALTER TABLE client DROP presentation_entreprise');
    }
}
