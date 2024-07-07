<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704085331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6D4D2E733');
        $this->addSql('DROP INDEX IDX_5A6DD5F6D4D2E733 ON server');
        $this->addSql('ALTER TABLE server CHANGE one_to_many_id connexion_method_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6E6775590 FOREIGN KEY (connexion_method_id) REFERENCES connexion_method (id)');
        $this->addSql('CREATE INDEX IDX_5A6DD5F6E6775590 ON server (connexion_method_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F6E6775590');
        $this->addSql('DROP INDEX IDX_5A6DD5F6E6775590 ON server');
        $this->addSql('ALTER TABLE server CHANGE connexion_method_id one_to_many_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F6D4D2E733 FOREIGN KEY (one_to_many_id) REFERENCES connexion_method (id)');
        $this->addSql('CREATE INDEX IDX_5A6DD5F6D4D2E733 ON server (one_to_many_id)');
    }
}
