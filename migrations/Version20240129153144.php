<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129153144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FC54C8C93 FOREIGN KEY (type_id) REFERENCES typevoiture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9E2810FC54C8C93 ON voiture (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FC54C8C93');
        $this->addSql('DROP INDEX UNIQ_E9E2810FC54C8C93 ON voiture');
        $this->addSql('ALTER TABLE voiture DROP type_id');
    }
}
