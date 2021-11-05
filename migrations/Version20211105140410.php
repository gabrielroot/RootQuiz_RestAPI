<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211105140410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pergunta (id INT NOT NULL, usuario_id INT DEFAULT NULL, resposta_correta VARCHAR(255) DEFAULT \'Nenhuma\' NOT NULL, questao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_124A7194DB38439E ON pergunta (usuario_id)');
        $this->addSql('CREATE TABLE resposta (id INT NOT NULL, pergunta_id INT DEFAULT NULL, alternativa VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A969063C763537 ON resposta (pergunta_id)');
        $this->addSql('CREATE TABLE tentativa (id INT NOT NULL, usuario_id INT DEFAULT NULL, pergunta_id INT DEFAULT NULL, erro_acerto BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCAE46E0DB38439E ON tentativa (usuario_id)');
        $this->addSql('CREATE INDEX IDX_DCAE46E03C763537 ON tentativa (pergunta_id)');
        $this->addSql('CREATE TABLE usuario (id INT NOT NULL, nome VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL, privilegio INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pergunta ADD CONSTRAINT FK_124A7194DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969063C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E03C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969063C763537');
        $this->addSql('ALTER TABLE tentativa DROP CONSTRAINT FK_DCAE46E03C763537');
        $this->addSql('ALTER TABLE pergunta DROP CONSTRAINT FK_124A7194DB38439E');
        $this->addSql('ALTER TABLE tentativa DROP CONSTRAINT FK_DCAE46E0DB38439E');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE tentativa');
        $this->addSql('DROP TABLE usuario');
    }
}
