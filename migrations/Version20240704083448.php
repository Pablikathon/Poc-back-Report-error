<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704083448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE connexion_method_server (connexion_method_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_778281D5E6775590 (connexion_method_id), INDEX IDX_778281D51844E6B7 (server_id), PRIMARY KEY(connexion_method_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE host_server (host_id INT NOT NULL, server_id INT NOT NULL, INDEX IDX_7E7A141D1FB8D185 (host_id), INDEX IDX_7E7A141D1844E6B7 (server_id), PRIMARY KEY(host_id, server_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE connexion_method_server ADD CONSTRAINT FK_778281D5E6775590 FOREIGN KEY (connexion_method_id) REFERENCES connexion_method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE connexion_method_server ADD CONSTRAINT FK_778281D51844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE host_server ADD CONSTRAINT FK_7E7A141D1FB8D185 FOREIGN KEY (host_id) REFERENCES host (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE host_server ADD CONSTRAINT FK_7E7A141D1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE connexion_method_server DROP FOREIGN KEY FK_778281D5E6775590');
        $this->addSql('ALTER TABLE connexion_method_server DROP FOREIGN KEY FK_778281D51844E6B7');
        $this->addSql('ALTER TABLE host_server DROP FOREIGN KEY FK_7E7A141D1FB8D185');
        $this->addSql('ALTER TABLE host_server DROP FOREIGN KEY FK_7E7A141D1844E6B7');
        $this->addSql('DROP TABLE connexion_method_server');
        $this->addSql('DROP TABLE host_server');
    }
}
