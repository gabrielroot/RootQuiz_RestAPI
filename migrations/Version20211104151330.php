<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211104151330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE perguntas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE perguntas (id INT NOT NULL, resposta_id INT DEFAULT NULL, resposta_correta INT NOT NULL, questao VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EC7ED22779F97242 ON perguntas (resposta_id)');
        $this->addSql('ALTER TABLE perguntas ADD CONSTRAINT FK_EC7ED22779F97242 FOREIGN KEY (resposta_id) REFERENCES respostas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE perguntas_id_seq CASCADE');
        $this->addSql('DROP TABLE perguntas');
    }
}
