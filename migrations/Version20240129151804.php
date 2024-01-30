<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129151804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, voiture_id INT DEFAULT NULL, clients_id INT DEFAULT NULL, note INT DEFAULT NULL, commentaire LONGTEXT DEFAULT NULL, date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8F91ABF0181A8BA (voiture_id), UNIQUE INDEX UNIQ_8F91ABF0AB014612 (clients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) DEFAULT NULL, nom_utilisateur VARCHAR(15) DEFAULT NULL, mot_de_pass VARCHAR(50) DEFAULT NULL, date_creation DATETIME DEFAULT NULL, nom VARCHAR(50) DEFAULT NULL, prenom VARCHAR(50) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, derniere_connexion DATETIME DEFAULT NULL, email_verifie TINYINT(1) DEFAULT NULL, permis_recto_path VARCHAR(255) DEFAULT NULL, permis_verso_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dommage_voiture (id INT AUTO_INCREMENT NOT NULL, voiture_id INT DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_76E7E27F181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locations (id INT AUTO_INCREMENT NOT NULL, voiture_id INT DEFAULT NULL, client_id INT DEFAULT NULL, date_de_debut DATE DEFAULT NULL, date_de_fin DATE DEFAULT NULL, total_paiement NUMERIC(10, 2) DEFAULT NULL, statut VARCHAR(40) DEFAULT NULL, INDEX IDX_17E64ABA181A8BA (voiture_id), INDEX IDX_17E64ABA19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maintenancevehicule (id INT AUTO_INCREMENT NOT NULL, voiture_id INT DEFAULT NULL, nombre_km VARCHAR(50) DEFAULT NULL, notes LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_24915BF2181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sanctions_locatives (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, montant NUMERIC(10, 2) DEFAULT NULL, raison VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_43398F6064D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_dommage (id INT AUTO_INCREMENT NOT NULL, dommage_voiture_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_C58930706BCA0C9E (dommage_voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE typevoiture (id INT AUTO_INCREMENT NOT NULL, voiture_id INT DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_33060DB4181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(25) DEFAULT NULL, modele VARCHAR(30) DEFAULT NULL, annee DATE DEFAULT NULL, couleur VARCHAR(20) DEFAULT NULL, prix_par_jour NUMERIC(10, 2) DEFAULT NULL, statut VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0AB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE dommage_voiture ADD CONSTRAINT FK_76E7E27F181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE locations ADD CONSTRAINT FK_17E64ABA19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE maintenancevehicule ADD CONSTRAINT FK_24915BF2181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE sanctions_locatives ADD CONSTRAINT FK_43398F6064D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
        $this->addSql('ALTER TABLE type_dommage ADD CONSTRAINT FK_C58930706BCA0C9E FOREIGN KEY (dommage_voiture_id) REFERENCES dommage_voiture (id)');
        $this->addSql('ALTER TABLE typevoiture ADD CONSTRAINT FK_33060DB4181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0181A8BA');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0AB014612');
        $this->addSql('ALTER TABLE dommage_voiture DROP FOREIGN KEY FK_76E7E27F181A8BA');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA181A8BA');
        $this->addSql('ALTER TABLE locations DROP FOREIGN KEY FK_17E64ABA19EB6921');
        $this->addSql('ALTER TABLE maintenancevehicule DROP FOREIGN KEY FK_24915BF2181A8BA');
        $this->addSql('ALTER TABLE sanctions_locatives DROP FOREIGN KEY FK_43398F6064D218E');
        $this->addSql('ALTER TABLE type_dommage DROP FOREIGN KEY FK_C58930706BCA0C9E');
        $this->addSql('ALTER TABLE typevoiture DROP FOREIGN KEY FK_33060DB4181A8BA');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE dommage_voiture');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE maintenancevehicule');
        $this->addSql('DROP TABLE sanctions_locatives');
        $this->addSql('DROP TABLE type_dommage');
        $this->addSql('DROP TABLE typevoiture');
        $this->addSql('DROP TABLE voiture');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
