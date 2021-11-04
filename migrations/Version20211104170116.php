<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104170116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE tentativas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE tentativas (id INT NOT NULL, usuario_id INT DEFAULT NULL, pergunta_id INT DEFAULT NULL, erro_acerto BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BBD88335DB38439E ON tentativas (usuario_id)');
        $this->addSql('CREATE INDEX IDX_BBD883353C763537 ON tentativas (pergunta_id)');
        $this->addSql('ALTER TABLE tentativas ADD CONSTRAINT FK_BBD88335DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativas ADD CONSTRAINT FK_BBD883353C763537 FOREIGN KEY (pergunta_id) REFERENCES perguntas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tentativas_id_seq CASCADE');
        $this->addSql('DROP TABLE tentativas');
    }
}
