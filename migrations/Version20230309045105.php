<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230309045105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero INT NOT NULL, produit VARCHAR(255) NOT NULL, reference_produit VARCHAR(255) NOT NULL, lien_du_produit VARCHAR(2000) DEFAULT NULL, prix_produit VARCHAR(255) NOT NULL, pays_de_destination VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, status TINYINT(1) DEFAULT NULL, notification VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, objet_contact VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, numero INT DEFAULT NULL, commentaires VARCHAR(2000) DEFAULT NULL, status TINYINT(1) DEFAULT NULL, notification VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expediteur (id INT AUTO_INCREMENT NOT NULL, transporteur_du_colis_id INT DEFAULT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, nombre_kilogramme INT NOT NULL, description_colis VARCHAR(1000) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, date_de_voyage_souhaiter DATE NOT NULL, status TINYINT(1) DEFAULT NULL, prix_envoie DOUBLE PRECISION DEFAULT NULL, notification VARCHAR(500) DEFAULT NULL, etat INT NOT NULL, numero_carte_identite VARCHAR(255) DEFAULT NULL, INDEX IDX_ABA4CF8E2F0CF921 (transporteur_du_colis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_pasword (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, token VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_676D20E6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyageur (id INT AUTO_INCREMENT NOT NULL, ville_depart VARCHAR(255) NOT NULL, ville_arrivee VARCHAR(255) NOT NULL, compagnie_de_voyage VARCHAR(255) NOT NULL, date_heure_depart DATETIME NOT NULL, date_heure_arrivee DATETIME NOT NULL, numero INT NOT NULL, kilo_disponible INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, status TINYINT(1) DEFAULT NULL, prix_achat DOUBLE PRECISION DEFAULT NULL, notification VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expediteur ADD CONSTRAINT FK_ABA4CF8E2F0CF921 FOREIGN KEY (transporteur_du_colis_id) REFERENCES voyageur (id)');
        $this->addSql('ALTER TABLE reset_pasword ADD CONSTRAINT FK_676D20E6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expediteur DROP FOREIGN KEY FK_ABA4CF8E2F0CF921');
        $this->addSql('ALTER TABLE reset_pasword DROP FOREIGN KEY FK_676D20E6A76ED395');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE expediteur');
        $this->addSql('DROP TABLE reset_pasword');
        $this->addSql('DROP TABLE voyageur');
    }
}
