<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104163521 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perguntas ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE perguntas ADD CONSTRAINT FK_EC7ED227DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_EC7ED227DB38439E ON perguntas (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE perguntas DROP CONSTRAINT FK_EC7ED227DB38439E');
        $this->addSql('DROP INDEX IDX_EC7ED227DB38439E');
        $this->addSql('ALTER TABLE perguntas DROP usuario_id');
    }
}
