<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129153257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE typevoiture DROP FOREIGN KEY FK_33060DB4181A8BA');
        $this->addSql('DROP INDEX IDX_33060DB4181A8BA ON typevoiture');
        $this->addSql('ALTER TABLE typevoiture DROP voiture_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE typevoiture ADD voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE typevoiture ADD CONSTRAINT FK_33060DB4181A8BA FOREIGN KEY (voiture_id) REFERENCES voiture (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_33060DB4181A8BA ON typevoiture (voiture_id)');
    }
}
