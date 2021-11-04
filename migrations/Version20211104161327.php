<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104161327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE perguntas DROP CONSTRAINT fk_ec7ed22779f97242');
        $this->addSql('DROP INDEX idx_ec7ed22779f97242');
        $this->addSql('ALTER TABLE perguntas DROP resposta_id');
        $this->addSql('ALTER TABLE respostas ADD pergunta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE respostas ADD CONSTRAINT FK_F20FC3573C763537 FOREIGN KEY (pergunta_id) REFERENCES perguntas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F20FC3573C763537 ON respostas (pergunta_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE respostas DROP CONSTRAINT FK_F20FC3573C763537');
        $this->addSql('DROP INDEX IDX_F20FC3573C763537');
        $this->addSql('ALTER TABLE respostas DROP pergunta_id');
        $this->addSql('ALTER TABLE perguntas ADD resposta_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE perguntas ADD CONSTRAINT fk_ec7ed22779f97242 FOREIGN KEY (resposta_id) REFERENCES respostas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ec7ed22779f97242 ON perguntas (resposta_id)');
    }
}
