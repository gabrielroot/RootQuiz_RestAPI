<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104211622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE respostas DROP CONSTRAINT fk_f20fc3573c763537');
        $this->addSql('ALTER TABLE tentativas DROP CONSTRAINT fk_bbd883353c763537');
        $this->addSql('DROP SEQUENCE respostas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE perguntas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tentativas_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE pergunta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resposta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tentativa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE pergunta (id INT NOT NULL, usuario_id INT DEFAULT NULL, resposta_correta_id INT NOT NULL, questao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_124A7194DB38439E ON pergunta (usuario_id)');
        $this->addSql('CREATE TABLE resposta (id INT NOT NULL, pergunta_id INT DEFAULT NULL, alternativa VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A969063C763537 ON resposta (pergunta_id)');
        $this->addSql('CREATE TABLE tentativa (id INT NOT NULL, usuario_id INT DEFAULT NULL, pergunta_id INT DEFAULT NULL, erro_acerto BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCAE46E0DB38439E ON tentativa (usuario_id)');
        $this->addSql('CREATE INDEX IDX_DCAE46E03C763537 ON tentativa (pergunta_id)');
        $this->addSql('ALTER TABLE pergunta ADD CONSTRAINT FK_124A7194DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969063C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativa ADD CONSTRAINT FK_DCAE46E03C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE respostas');
        $this->addSql('DROP TABLE perguntas');
        $this->addSql('DROP TABLE tentativas');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969063C763537');
        $this->addSql('ALTER TABLE tentativa DROP CONSTRAINT FK_DCAE46E03C763537');
        $this->addSql('DROP SEQUENCE pergunta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resposta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tentativa_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE respostas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE perguntas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tentativas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE respostas (id INT NOT NULL, pergunta_id INT DEFAULT NULL, alternativa VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_f20fc3573c763537 ON respostas (pergunta_id)');
        $this->addSql('CREATE TABLE perguntas (id INT NOT NULL, usuario_id INT DEFAULT NULL, resposta_correta_id INT NOT NULL, questao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_ec7ed227db38439e ON perguntas (usuario_id)');
        $this->addSql('CREATE TABLE tentativas (id INT NOT NULL, usuario_id INT DEFAULT NULL, pergunta_id INT DEFAULT NULL, erro_acerto BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_bbd883353c763537 ON tentativas (pergunta_id)');
        $this->addSql('CREATE INDEX idx_bbd88335db38439e ON tentativas (usuario_id)');
        $this->addSql('ALTER TABLE respostas ADD CONSTRAINT fk_f20fc3573c763537 FOREIGN KEY (pergunta_id) REFERENCES perguntas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE perguntas ADD CONSTRAINT fk_ec7ed227db38439e FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativas ADD CONSTRAINT fk_bbd88335db38439e FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tentativas ADD CONSTRAINT fk_bbd883353c763537 FOREIGN KEY (pergunta_id) REFERENCES perguntas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE tentativa');
    }
}
